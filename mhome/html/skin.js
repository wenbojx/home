// Garden Gnome Software - Skin
// Pano2VR 4.0/3102S
// Filename: apple iphone.ggsk
// Generated 周二 三月 5 10:37:26 2013

function pano2vrSkin(player,base) {
	var me=this;
	var flag=false;
	var nodeMarker=new Array();
	var activeNodeMarker=new Array();
	this.player=player;
	this.player.skinObj=this;
	this.divSkin=player.divSkin;
	var basePath="";
	// auto detect base path
	if (base=='?') {
		var scripts = document.getElementsByTagName('script');
		for(var i=0;i<scripts.length;i++) {
			var src=scripts[i].src;
			if (src.indexOf('skin.js')>=0) {
				var p=src.lastIndexOf('/');
				if (p>=0) {
					basePath=src.substr(0,p+1);
				}
			}
		}
	} else
	if (base) {
		basePath=base;
	}
	this.elementMouseDown=new Array();
	this.elementMouseOver=new Array();
	var cssPrefix='';
	var domTransition='transition';
	var domTransform='transform';
	var prefixes='Webkit,Moz,O,ms,Ms'.split(',');
	var i;
	for(i=0;i<prefixes.length;i++) {
		if (typeof document.body.style[prefixes[i] + 'Transform'] !== 'undefined') {
			cssPrefix='-' + prefixes[i].toLowerCase() + '-';
			domTransition=prefixes[i] + 'Transition';
			domTransform=prefixes[i] + 'Transform';
		}
	}
	
	this.player.setMargins(0,0,0,0);
	
	this.updateSize=function(startElement) {
		var stack=new Array();
		stack.push(startElement);
		while(stack.length>0) {
			e=stack.pop();
			if (e.ggUpdatePosition) {
				e.ggUpdatePosition();
			}
			if (e.hasChildNodes()) {
				for(i=0;i<e.childNodes.length;i++) {
					stack.push(e.childNodes[i]);
				}
			}
		}
	}
	
	parameterToTransform=function(p) {
		return 'translate(' + p.rx + 'px,' + p.ry + 'px) rotate(' + p.a + 'deg) scale(' + p.sx + ',' + p.sy + ')';
	}
	
	this.findElements=function(id,regex) {
		var r=new Array();
		var stack=new Array();
		var pat=new RegExp(id,'');
		stack.push(me.divSkin);
		while(stack.length>0) {
			e=stack.pop();
			if (regex) {
				if (pat.test(e.ggId)) r.push(e);
			} else {
				if (e.ggId==id) r.push(e);
			}
			if (e.hasChildNodes()) {
				for(i=0;i<e.childNodes.length;i++) {
					stack.push(e.childNodes[i]);
				}
			}
		}
		return r;
	}
	
	this.addSkin=function() {
		this._control=document.createElement('div');
		this._control.ggId='control';
		this._control.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		this._control.ggVisible=true;
		hs ='position:absolute;';
		hs+='left: 1px;';
		hs+='top:  1px;';
		hs+='width: 156px;';
		hs+='height: 153px;';
		hs+=cssPrefix + 'transform-origin: 50% 50%;';
		hs+='visibility: inherit;';
		this._control.setAttribute('style',hs);
		this._compass=document.createElement('div');
		this._compass.ggId='compass';
		this._compass.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		this._compass.ggVisible=false;
		hs ='position:absolute;';
		hs+='left: 22px;';
		hs+='top:  10px;';
		hs+='width: 87px;';
		hs+='height: 99px;';
		hs+=cssPrefix + 'transform-origin: 50% 50%;';
		hs+='visibility: hidden;';
		this._compass.setAttribute('style',hs);
		this._compass__img=document.createElement('img');
		this._compass__img.setAttribute('src',basePath + 'images/compass.png');
		this._compass__img.setAttribute('style','position: absolute;top: 0px;left: 0px;');
		me.player.checkLoaded.push(this._compass__img);
		this._compass.appendChild(this._compass__img);
		this._control.appendChild(this._compass);
		this._range=document.createElement('div');
		this._range.ggId='Range';
		this._range.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		this._range.ggVisible=true;
		hs ='position:absolute;';
		hs+='left: 34px;';
		hs+='top:  16px;';
		hs+='width: 63px;';
		hs+='height: 45px;';
		hs+=cssPrefix + 'transform-origin: 50% 50%;';
		hs+='visibility: inherit;';
		this._range.setAttribute('style',hs);
		this._range__img=document.createElement('img');
		this._range__img.setAttribute('src',basePath + 'images/range.png');
		this._range__img.setAttribute('style','position: absolute;top: 0px;left: 0px;');
		me.player.checkLoaded.push(this._range__img);
		this._range.appendChild(this._range__img);
		this._control.appendChild(this._range);
		this._backimage=document.createElement('div');
		this._backimage.ggId='backimage';
		this._backimage.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		this._backimage.ggVisible=true;
		hs ='position:absolute;';
		hs+='left: 23px;';
		hs+='top:  19px;';
		hs+='width: 84px;';
		hs+='height: 84px;';
		hs+=cssPrefix + 'transform-origin: 50% 50%;';
		hs+='visibility: inherit;';
		this._backimage.setAttribute('style',hs);
		this._backimage__img=document.createElement('img');
		this._backimage__img.setAttribute('src',basePath + 'images/backimage.png');
		this._backimage__img.setAttribute('style','position: absolute;top: 0px;left: 0px;');
		me.player.checkLoaded.push(this._backimage__img);
		this._backimage.appendChild(this._backimage__img);
		this._control.appendChild(this._backimage);
		this._north=document.createElement('div');
		this._north.ggId='North';
		this._north.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		this._north.ggVisible=true;
		hs ='position:absolute;';
		hs+='left: 54px;';
		hs+='top:  28px;';
		hs+='width: 24px;';
		hs+='height: 19px;';
		hs+=cssPrefix + 'transform-origin: 50% 50%;';
		hs+='visibility: inherit;';
		hs+='cursor: pointer;';
		this._north.setAttribute('style',hs);
		this._north__img=document.createElement('img');
		this._north__img.setAttribute('src',basePath + 'images/north.png');
		this._north__img.setAttribute('style','position: absolute;top: 0px;left: 0px;width: 24px;height: 19px;');
		this._north.appendChild(this._north__img);
		this._north.onmouseover=function () {
			me._north__img.src=basePath + 'images/north__o.png';
		}
		this._north.onmouseout=function () {
			me._north__img.src=basePath + 'images/north.png';
			me.elementMouseDown['north']=false;
		}
		this._north.onmousedown=function () {
			me._north__img.src=basePath + 'images/north__a.png';
			me.elementMouseDown['north']=true;
		}
		this._north.onmouseup=function () {
			me._north__img.src=basePath + 'images/north.png';
			me.elementMouseDown['north']=false;
		}
		this._north.ontouchend=function () {
			me.elementMouseDown['north']=false;
		}
		this._control.appendChild(this._north);
		this._south=document.createElement('div');
		this._south.ggId='South';
		this._south.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		this._south.ggVisible=true;
		hs ='position:absolute;';
		hs+='left: 53px;';
		hs+='top:  72px;';
		hs+='width: 24px;';
		hs+='height: 19px;';
		hs+=cssPrefix + 'transform-origin: 50% 50%;';
		hs+='visibility: inherit;';
		this._south.setAttribute('style',hs);
		this._south__img=document.createElement('img');
		this._south__img.setAttribute('src',basePath + 'images/south.png');
		this._south__img.setAttribute('style','position: absolute;top: 0px;left: 0px;width: 24px;height: 19px;');
		this._south.appendChild(this._south__img);
		this._south.onmouseover=function () {
			me._south__img.src=basePath + 'images/south__o.png';
		}
		this._south.onmouseout=function () {
			me._south__img.src=basePath + 'images/south.png';
			me.elementMouseDown['south']=false;
		}
		this._south.onmousedown=function () {
			me._south__img.src=basePath + 'images/south__a.png';
			me.elementMouseDown['south']=true;
		}
		this._south.onmouseup=function () {
			me._south__img.src=basePath + 'images/south.png';
			me.elementMouseDown['south']=false;
		}
		this._south.ontouchend=function () {
			me.elementMouseDown['south']=false;
		}
		this._control.appendChild(this._south);
		this._east=document.createElement('div');
		this._east.ggId='East';
		this._east.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		this._east.ggVisible=true;
		hs ='position:absolute;';
		hs+='left: 78px;';
		hs+='top:  48px;';
		hs+='width: 19px;';
		hs+='height: 24px;';
		hs+=cssPrefix + 'transform-origin: 50% 50%;';
		hs+='visibility: inherit;';
		this._east.setAttribute('style',hs);
		this._east__img=document.createElement('img');
		this._east__img.setAttribute('src',basePath + 'images/east.png');
		this._east__img.setAttribute('style','position: absolute;top: 0px;left: 0px;width: 19px;height: 24px;');
		this._east.appendChild(this._east__img);
		this._east.onmouseover=function () {
			me._east__img.src=basePath + 'images/east__o.png';
		}
		this._east.onmouseout=function () {
			me._east__img.src=basePath + 'images/east.png';
			me.elementMouseDown['east']=false;
		}
		this._east.onmousedown=function () {
			me._east__img.src=basePath + 'images/east__a.png';
			me.elementMouseDown['east']=true;
		}
		this._east.onmouseup=function () {
			me._east__img.src=basePath + 'images/east.png';
			me.elementMouseDown['east']=false;
		}
		this._east.ontouchend=function () {
			me.elementMouseDown['east']=false;
		}
		this._control.appendChild(this._east);
		this._west=document.createElement('div');
		this._west.ggId='West';
		this._west.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		this._west.ggVisible=true;
		hs ='position:absolute;';
		hs+='left: 34px;';
		hs+='top:  48px;';
		hs+='width: 18px;';
		hs+='height: 24px;';
		hs+=cssPrefix + 'transform-origin: 50% 50%;';
		hs+='visibility: inherit;';
		this._west.setAttribute('style',hs);
		this._west__img=document.createElement('img');
		this._west__img.setAttribute('src',basePath + 'images/west.png');
		this._west__img.setAttribute('style','position: absolute;top: 0px;left: 0px;width: 18px;height: 24px;');
		this._west.appendChild(this._west__img);
		this._west.onmouseover=function () {
			me._west__img.src=basePath + 'images/west__o.png';
		}
		this._west.onmouseout=function () {
			me._west__img.src=basePath + 'images/west.png';
			me.elementMouseDown['west']=false;
		}
		this._west.onmousedown=function () {
			me._west__img.src=basePath + 'images/west__a.png';
			me.elementMouseDown['west']=true;
		}
		this._west.onmouseup=function () {
			me._west__img.src=basePath + 'images/west.png';
			me.elementMouseDown['west']=false;
		}
		this._west.ontouchend=function () {
			me.elementMouseDown['west']=false;
		}
		this._control.appendChild(this._west);
		this._zoom_in=document.createElement('div');
		this._zoom_in.ggId='zoom_in';
		this._zoom_in.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		this._zoom_in.ggVisible=true;
		hs ='position:absolute;';
		hs+='left: 54px;';
		hs+='top:  117px;';
		hs+='width: 22px;';
		hs+='height: 22px;';
		hs+=cssPrefix + 'transform-origin: 50% 50%;';
		hs+='visibility: inherit;';
		hs+='cursor: pointer;';
		this._zoom_in.setAttribute('style',hs);
		this._zoom_in__img=document.createElement('img');
		this._zoom_in__img.setAttribute('src',basePath + 'images/zoom_in.png');
		this._zoom_in__img.setAttribute('style','position: absolute;top: 0px;left: 0px;width: 22px;height: 22px;');
		this._zoom_in.appendChild(this._zoom_in__img);
		this._zoom_in.onmouseover=function () {
			me._zoom_in__img.src=basePath + 'images/zoom_in__o.png';
		}
		this._zoom_in.onmouseout=function () {
			me._zoom_in__img.src=basePath + 'images/zoom_in.png';
			me.elementMouseDown['zoom_in']=false;
		}
		this._zoom_in.onmousedown=function () {
			me._zoom_in__img.src=basePath + 'images/zoom_in__a.png';
			me.elementMouseDown['zoom_in']=true;
		}
		this._zoom_in.onmouseup=function () {
			me._zoom_in__img.src=basePath + 'images/zoom_in.png';
			me.elementMouseDown['zoom_in']=false;
		}
		this._zoom_in.ontouchend=function () {
			me.elementMouseDown['zoom_in']=false;
		}
		this._control.appendChild(this._zoom_in);
		this._zoom_out=document.createElement('div');
		this._zoom_out.ggId='zoom_out';
		this._zoom_out.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
		this._zoom_out.ggVisible=true;
		hs ='position:absolute;';
		hs+='left: 117px;';
		hs+='top:  51px;';
		hs+='width: 22px;';
		hs+='height: 22px;';
		hs+=cssPrefix + 'transform-origin: 50% 50%;';
		hs+='visibility: inherit;';
		this._zoom_out.setAttribute('style',hs);
		this._zoom_out__img=document.createElement('img');
		this._zoom_out__img.setAttribute('src',basePath + 'images/zoom_out.png');
		this._zoom_out__img.setAttribute('style','position: absolute;top: 0px;left: 0px;width: 22px;height: 22px;');
		this._zoom_out.appendChild(this._zoom_out__img);
		this._zoom_out.onmouseover=function () {
			me._zoom_out__img.src=basePath + 'images/zoom_out__o.png';
		}
		this._zoom_out.onmouseout=function () {
			me._zoom_out__img.src=basePath + 'images/zoom_out.png';
			me.elementMouseDown['zoom_out']=false;
		}
		this._zoom_out.onmousedown=function () {
			me._zoom_out__img.src=basePath + 'images/zoom_out__a.png';
			me.elementMouseDown['zoom_out']=true;
		}
		this._zoom_out.onmouseup=function () {
			me._zoom_out__img.src=basePath + 'images/zoom_out.png';
			me.elementMouseDown['zoom_out']=false;
		}
		this._zoom_out.ontouchend=function () {
			me.elementMouseDown['zoom_out']=false;
		}
		this._control.appendChild(this._zoom_out);
		this.divSkin.appendChild(this._control);
		this.__14=document.createElement('div');
		this.__14.ggId='\u56fe\u7247 14';
		this.__14.ggParameter={ rx:0,ry:0,a:0,sx:0.6,sy:0.6 };
		this.__14.ggVisible=true;
		this.__14.ggUpdatePosition=function() {
			this.style[domTransition]='none';
			if (this.parentNode) {
				w=this.parentNode.offsetWidth;
				this.style.left=(-151 + w) + 'px';
				h=this.parentNode.offsetHeight;
				this.style.top=(-149 + h) + 'px';
			}
		}
		hs ='position:absolute;';
		hs+='left: -151px;';
		hs+='top:  -149px;';
		hs+='width: 178px;';
		hs+='height: 182px;';
		hs+=cssPrefix + 'transform-origin: 50% 50%;';
		hs+=cssPrefix + 'transform: ' + parameterToTransform(this.__14.ggParameter) + ';';
		hs+='visibility: inherit;';
		this.__14.setAttribute('style',hs);
		this.__14__img=document.createElement('img');
		this.__14__img.setAttribute('src',basePath + 'images/_14.png');
		this.__14__img.setAttribute('style','position: absolute;top: 0px;left: 0px;');
		me.player.checkLoaded.push(this.__14__img);
		this.__14.appendChild(this.__14__img);
		this.divSkin.appendChild(this.__14);
		this.divSkin.ggUpdateSize=function(w,h) {
			me.updateSize(me.divSkin);
		}
		this.divSkin.ggViewerInit=function() {
		}
		this.divSkin.ggLoaded=function() {
		}
		this.divSkin.ggReLoaded=function() {
		}
		this.divSkin.ggEnterFullscreen=function() {
		}
		this.divSkin.ggExitFullscreen=function() {
		}
		this.skinTimerEvent();
	};
	this.hotspotProxyClick=function(id) {
	}
	this.hotspotProxyOver=function(id) {
	}
	this.hotspotProxyOut=function(id) {
	}
	this.changeActiveNode=function(id) {
		var newMarker=new Array();
		var i,j;
		var tags=me.player.userdata.tags;
		for (i=0;i<nodeMarker.length;i++) {
			var match=false;
			if (nodeMarker[i].ggMarkerNodeId==id) match=true;
			for(j=0;j<tags.length;j++) {
				if (nodeMarker[i].ggMarkerNodeId==tags[j]) match=true;
			}
			if (match) {
				newMarker.push(nodeMarker[i]);
			}
		}
		for(i=0;i<activeNodeMarker.length;i++) {
			if (newMarker.indexOf(activeNodeMarker[i])<0) {
				if (activeNodeMarker[i].ggMarkerNormal) {
					activeNodeMarker[i].ggMarkerNormal.style.visibility='inherit';
				}
				if (activeNodeMarker[i].ggMarkerActive) {
					activeNodeMarker[i].ggMarkerActive.style.visibility='hidden';
				}
				if (activeNodeMarker[i].ggDeactivate) {
					activeNodeMarker[i].ggDeactivate();
				}
			}
		}
		for(i=0;i<newMarker.length;i++) {
			if (activeNodeMarker.indexOf(newMarker[i])<0) {
				if (newMarker[i].ggMarkerNormal) {
					newMarker[i].ggMarkerNormal.style.visibility='hidden';
				}
				if (newMarker[i].ggMarkerActive) {
					newMarker[i].ggMarkerActive.style.visibility='inherit';
				}
				if (newMarker[i].ggActivate) {
					newMarker[i].ggActivate();
				}
			}
		}
		activeNodeMarker=newMarker;
	}
	this.skinTimerEvent=function() {
		setTimeout(function() { me.skinTimerEvent(); }, 10);
		var hs='';
		if (me._compass.ggParameter) {
			hs+=parameterToTransform(me._compass.ggParameter) + ' ';
		}
		hs+='rotate(' + (-1.0*(1 * me.player.getPanNorth() + 0)) + 'deg) ';
		me._compass.style[domTransform]=hs;
		var hs='';
		if (me._range.ggParameter) {
			hs+=parameterToTransform(me._range.ggParameter) + ' ';
		}
		hs+='scale(' + (Math.tan(me.player.getFov()/2.0*Math.PI/180.0)*1 + 0) + ',1.0) ';
		me._range.style[domTransform]=hs;
		if (me.elementMouseDown['north']) {
			me.player.changeTilt(0.5,true);
		}
		if (me.elementMouseDown['south']) {
			me.player.changeTilt(-0.5,true);
		}
		if (me.elementMouseDown['east']) {
			me.player.changePan(-0.5,true);
		}
		if (me.elementMouseDown['west']) {
			me.player.changePan(0.5,true);
		}
		if (me.elementMouseDown['zoom_in']) {
			me.player.changeFovLog(-0.5,true);
		}
		if (me.elementMouseDown['zoom_out']) {
			me.player.changeFovLog(0.5,true);
		}
	};
	function SkinHotspotClass(skinObj,hotspot) {
		var me=this;
		var flag=false;
		this.player=skinObj.player;
		this.skin=skinObj;
		this.hotspot=hotspot;
		this.elementMouseDown=new Array();
		this.elementMouseOver=new Array();
		this.__div=document.createElement('div');
		this.__div.setAttribute('style','position:absolute; left:0px;top:0px;visibility: inherit;');
		
		this.findElements=function(id,regex) {
			return me.skin.findElements(id,regex);
		}
		
		{
			this.__div=document.createElement('div');
			this.__div.ggId='hotspot';
			this.__div.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
			this.__div.ggVisible=true;
			hs ='position:absolute;';
			hs+='left: 471px;';
			hs+='top:  90px;';
			hs+='width: 5px;';
			hs+='height: 5px;';
			hs+=cssPrefix + 'transform-origin: 50% 50%;';
			hs+='visibility: inherit;';
			this.__div.setAttribute('style',hs);
			this.__div.onclick=function () {
				me.player.openUrl(me.hotspot.url,me.hotspot.target);
				me.skin.hotspotProxyClick(me.hotspot.id);
			}
			this.__div.onmouseover=function () {
				me.player.hotspot=me.hotspot;
				me._hstext.style[domTransition]='none';
				me._hstext.style.visibility='inherit';
				me._hstext.ggVisible=true;
				me.skin.hotspotProxyOver(me.hotspot.id);
			}
			this.__div.onmouseout=function () {
				me.player.hotspot=me.player.emptyHotspot;
				me._hstext.style[domTransition]='none';
				me._hstext.style.visibility='hidden';
				me._hstext.ggVisible=false;
				me.skin.hotspotProxyOut(me.hotspot.id);
			}
			this._hsimage=document.createElement('div');
			this._hsimage.ggId='hsimage';
			this._hsimage.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
			this._hsimage.ggVisible=true;
			hs ='position:absolute;';
			hs+='left: -18px;';
			hs+='top:  -10px;';
			hs+='width: 39px;';
			hs+='height: 39px;';
			hs+=cssPrefix + 'transform-origin: 50% 50%;';
			hs+='visibility: inherit;';
			this._hsimage.setAttribute('style',hs);
			this._hsimage__img=document.createElement('img');
			this._hsimage__img.setAttribute('src',basePath + 'images/hsimage.png');
			this._hsimage__img.setAttribute('style','position: absolute;top: 0px;left: 0px;');
			me.player.checkLoaded.push(this._hsimage__img);
			this._hsimage.appendChild(this._hsimage__img);
			this.__div.appendChild(this._hsimage);
			this._hstext=document.createElement('div');
			this._hstext.ggId='hstext';
			this._hstext.ggParameter={ rx:0,ry:0,a:0,sx:1,sy:1 };
			this._hstext.ggVisible=false;
			this._hstext.ggUpdatePosition=function() {
				this.style[domTransition]='none';
				this.style.left=(-49 + (101-this.offsetWidth)/2) + 'px';
			}
			hs ='position:absolute;';
			hs+='left: -49px;';
			hs+='top:  38px;';
			hs+='width: auto;';
			hs+='height: auto;';
			hs+=cssPrefix + 'transform-origin: 50% 50%;';
			hs+='visibility: hidden;';
			hs+='border: 1px solid #000000;';
			hs+='color: #000000;';
			hs+='background-color: #ffffff;';
			hs+='text-align: center;';
			hs+='white-space: nowrap;';
			hs+='white-space: nowrap;';
			hs+='padding: 0px 1px 0px 1px;';
			hs+='overflow: hidden;';
			this._hstext.setAttribute('style',hs);
			this._hstext.innerHTML=me.hotspot.title;
			this.__div.appendChild(this._hstext);
		}
	};
	this.addSkinHotspot=function(hotspot) {
		return new SkinHotspotClass(me,hotspot);
	}
	this.addSkin();
};