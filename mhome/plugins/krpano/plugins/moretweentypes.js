/* krpanoJS 1.0.8.15 moretweentypes plugin (build 2012-10-05) */
var krpanoplugin=function(){function d(a,c,b){return a<1/2.75?b*7.5625*a*a+c:a<2/2.75?b*(7.5625*(a-=1.5/2.75)*a+0.75)+c:a<2.5/2.75?b*(7.5625*(a-=2.25/2.75)*a+0.9375)+c:b*(7.5625*(a-=2.625/2.75)*a+0.984375)+c}function e(a,c,b){return((a/=0.5)<1?b/2*a*a:-b/2*(--a*(a-2)-1))+c}function f(a,c,b){return a<0.5?-(b/2)*a*2*(a*2-2)+c:b/2*(a*2-1)*(a*2-1)+(c+b/2)}function g(a,c,b){return(a/=0.5)<1?b/2*a*a*a+c:b/2*((a-=2)*a*a+2)+c}function h(a,c,b){if(a<0.5){a=a*2;c=b/2*((a-=1)*a*a+1)+c}else c=b/2*(a*2-1)*(a*
2-1)*(a*2-1)+(c+b/2);return c}function i(a,c,b){return(a/=0.5)<1?b/2*a*a*a*a+c:-b/2*((a-=2)*a*a*a-2)+c}function j(a,c,b){if(a<0.5){a=a*2;c=-(b/2)*((a-=1)*a*a*a-1)+c}else c=b/2*(a*2-1)*(a*2-1)*(a*2-1)*(a*2-1)+(c+b/2);return c}function k(a,c,b){return(a/=0.5)<1?b/2*a*a*a*a*a+c:b/2*((a-=2)*a*a*a*a+2)+c}function l(a,c,b){if(a<0.5){a=a*2;c=b/2*((a-=1)*a*a*a*a+1)+c}else c=b/2*(a*2-1)*(a*2-1)*(a*2-1)*(a*2-1)*(a*2-1)+(c+b/2);return c}function m(a,c,b){return-b/2*(Math.cos(Math.PI*a)-1)+c}function n(a,c,b){return a<
0.5?b/2*Math.sin(a*2*(Math.PI/2))+c:-(b/2)*Math.cos((a*2-1)*(Math.PI/2))+b/2+(c+b/2)}function o(a,c,b){return a<0.5?a*2==1?c+b/2:b/2*1.001*(-Math.pow(2,-10*a*2)+1)+c:a*2-1==0?c+b/2:b/2*Math.pow(2,10*(a*2-1-1))+(c+b/2)-b/2*0.001}function p(a,c,b){if(a==0)return c;if(a==1)return c+b;if(a/2<1)return b/2*Math.pow(2,10*(a-1))+c-b*5.0E-4;return b/2*1.0005*(-Math.pow(2,-10*--a)+2)+c}function q(a,c,b){return(a/=0.5)<1?-b/2*(Math.sqrt(1-a*a)-1)+c:b/2*(Math.sqrt(1-(a-=2)*a)+1)+c}function r(a,c,b){if(a<0.5){a=
a*2;c=b/2*Math.sqrt(1-(a-=1)*a)+c}else c=-(b/2)*(Math.sqrt(1-(a*2-1)*(a*2-1))-1)+(c+b/2);return c}function s(a,c,b){return a<0.5?(b-d(1-a*2,0,b)+0)*0.5+c:d(a*2-1,0,b)*0.5+b*0.5+c}function t(a,c,b){return a<0.5?d(a*2,c,b/2):b/2-d(1-(a*2-1),0,b/2)+(c+b/2)}this.registerplugin=function(a){a.tweentypes.easeinoutquad=e;a.tweentypes.easeoutinquad=f;a.tweentypes.easeinoutcubic=g;a.tweentypes.easeoutincubic=h;a.tweentypes.easeinoutquart=i;a.tweentypes.easeoutinquart=j;a.tweentypes.easeinoutquint=k;a.tweentypes.easeoutinquint=
l;a.tweentypes.easeinoutsine=m;a.tweentypes.easeoutinsine=n;a.tweentypes.easeoutinexpo=o;a.tweentypes.easeinoutexpo=p;a.tweentypes.easeinoutcirc=q;a.tweentypes.easeoutincirc=r;a.tweentypes.easeinoutbounce=s;a.tweentypes.easeoutinbounce=t};this.unloadplugin=function(){}};
