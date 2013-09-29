/*referenced at: http://jsfiddle.net/g3x84/1 */
window.search = function (url)
	{
		if (url.indexOf("?") === -1 || url.indexOf("v=") === -1)
		return;
		
		var query_string = url.substr(url.indexOf("?")+1),
			arr = [];
		
		parse_str(query_string, arr);
		
		var xhr;
		
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xhr=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		
		
		//xhr.onload = function(oEvent)
		xhr.onreadystatechange = function(oEvent)
		{
			if (xhr.status == 200 && xhr.readyState==4 )
			{
				var obj = JSON.parse(xhr.responseText);
				
				var n=url.replace("/watch?v=","/embed/"); 
				
				var content = [];
				
				content.push(
					'Play It To Add It',
					'<iframe width="560" height="315" src="'+n+'" frameborder="0" allowfullscreen></iframe>',
							'<input type="hidden" name="url" value="'+n+'"/>',
					'Title &nbsp <input type="text" name="title" style="width:300px;" value="'+obj.entry.title['$t']+'"/>'
				);
				
				document.getElementById('data').innerHTML = content.join('<br />');
			}
		}
		xhr.open("GET", "http://gdata.youtube.com/feeds/api/videos/" + arr['v'] + "?v=2&alt=json", false);
		xhr.send(null);
	}


	window.parse_str = function (str, array)
	{
		var strArr = String(str).replace(/^&/, '').replace(/&$/, '').split('&'),
			sal    = strArr.length,
			fixStr = function (str)
			{
				return decodeURIComponent(str.replace(/\+/g, '%20'));
			},
			i, j, ct, p, lastObj, obj, lastIter, undef, chr, tmp, key, value, postLeftBracketPos, keys, keysLen;

		
		if (!array)
		array = this.window;


		for (i = 0; i < sal; i++)
		{
			tmp   = strArr[i].split('=');
			key   = fixStr(tmp[0]);
			value = (tmp.length < 2) ? '' : fixStr(tmp[1]);

			while (key.charAt(0) === ' ')
			key = key.slice(1);
			
			if (key.indexOf('\x00') > -1)
			key = key.slice(0, key.indexOf('\x00'));
			
			if (key && key.charAt(0) !== '[')
			{
				keys = [];
				postLeftBracketPos = 0;
			
				for (j = 0; j < key.length; j++)
				{
					if (key.charAt(j) === '[' && !postLeftBracketPos)
					{
						postLeftBracketPos = j + 1;
					}
					else if (key.charAt(j) === ']')
					{
						if (postLeftBracketPos)
						{
							if (!keys.length)
							keys.push(key.slice(0, postLeftBracketPos - 1));
							
							keys.push(key.substr(postLeftBracketPos, j - postLeftBracketPos));
							postLeftBracketPos = 0;
		
							if (key.charAt(j + 1) !== '[')
							break;
						}
					}
				}
				
				if (!keys.length)
				keys = [key];
				
				for (j = 0; j < keys[0].length; j++)
				{
					chr = keys[0].charAt(j);
					
					if (chr === ' ' || chr === '.' || chr === '[')
					keys[0] = keys[0].substr(0, j) + '_' + keys[0].substr(j + 1);
		
					if (chr === '[')
					break;
				}

				obj = array;
				
				for (j = 0, keysLen = keys.length; j < keysLen; j++)
				{
					key = keys[j].replace(/^['"]/, '').replace(/['"]$/, '');
					lastIter = j !== keys.length - 1;
					lastObj = obj;
					
					if ((key !== '' && key !== ' ') || j === 0)
					{
						if (obj[key] === undef)
						obj[key] = {};
						
						obj = obj[key];
					}
					else
					{
						ct = -1;
						
						for (p in obj)
						{
							if (obj.hasOwnProperty(p))
							{
								if (+p > ct && p.match(/^\d+$/g))
								ct = +p;
							}
						}
						
						key = ct + 1;
					}
				}
				
				lastObj[key] = value;
			}
		}
	}