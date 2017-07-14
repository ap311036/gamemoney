function LoadJSCodeBlob(e,t){var o=document.createElement("script");o.src=URL.createObjectURL(e),o.onload=t,document.body.appendChild(o)}function LoadJSCode(e,t){var o=new Blob([e],{type:"text/javascript"});if(Math.fround&&-1==browser.indexOf("Chrome"))LoadJSCodeBlob(o,t);else{console.log("optimizing out Math.fround calls");var n=new FileReader;n.onload=function(e){var o=e.target.result.replace(/Math_fround\(/g,"("),n=new Blob([o],{type:"text/javascript"});LoadJSCodeBlob(n,t)},n.readAsText(o)}}function DecompressAndLoadFile(e,t,o){tryServerCompression=!1,e+="gz";var n=new XMLHttpRequest;n.open("GET",e,!0),n.onprogress=o,n.responseType="arraybuffer",n.onload=function(){var o=new Uint8Array(n.response),a=(new Date).getTime(),i=pako.inflate(o),r=(new Date).getTime();console.log("Decompressed "+e+" in "+(r-a)+"ms. You can remove this delay if you configure your web server to host files using gzip compression."),t(i)},n.send(null)}function LoadCompressedFile(e,t,o){if(CompressionState.current==CompressionState.Unsupported)return void DecompressAndLoadFile(e,t);if(CompressionState.current==CompressionState.Pending)return void CompressionState.pendingServerRequests.push(function(){LoadCompressedFile(e,t,o)});CompressionState.current==CompressionState.Uninitialized&&(CompressionState.current=CompressionState.Pending);var n=new XMLHttpRequest;n.open("GET",e,!0),n.responseType="arraybuffer",n.onprogress=function(e){o&&o(e),CompressionState.current==CompressionState.Pending&&(0==n.status||200==n.status?CompressionState.Set(CompressionState.Supported):CompressionState.Set(CompressionState.Unsupported))},n.onload=function(){if(0==n.status||200==n.status){CompressionState.Set(CompressionState.Supported);var a=new Uint8Array(n.response);t(a)}else CompressionState.Set(CompressionState.Unsupported),DecompressAndLoadFile(e,t,o)},n.onerror=function(){CompressionState.Set(CompressionState.Unsupported),DecompressAndLoadFile(e,t,o)};try{n.send(null)}catch(a){CompressionState.Set(CompressionState.Unsupported),DecompressAndLoadFile(e,t,o)}}function LoadCompressedJS(e,t){LoadCompressedFile(e,function(e){LoadJSCode(e,t)})}function fetchRemotePackageWrapper(e,t,o,n){LoadCompressedFile(e,o,function(o){var n=e,a=t;if(o.total&&(a=o.total),o.loaded){Module.dataFileDownloads||(Module.dataFileDownloads={}),Module.dataFileDownloads[n]={loaded:o.loaded,total:a};var i=0,r=0,s=0;for(var l in Module.dataFileDownloads){var d=Module.dataFileDownloads[l];i+=d.total,r+=d.loaded,s++}i=Math.ceil(i*Module.expectedDataFileDownloads/s),Module.setStatus&&Module.setStatus("Downloading data... ("+r+"/"+i+")")}else Module.dataFileDownloads||Module.setStatus&&Module.setStatus("Downloading data...")})}function CompatibilityCheck(){hasWebGL?mobile?confirm("Please note that Unity WebGL is not currently supported on mobiles. Press Ok if you wish to continue anyway.")||window.history.back():-1==browser.indexOf("Firefox")&&-1==browser.indexOf("Chrome")&&-1==browser.indexOf("Safari")&&(confirm("Please note that your browser is not currently supported for this Unity WebGL content. Try installing Firefox, or press Ok if you wish to continue anyway.")||window.history.back()):(alert("You need a browser which supports WebGL to run this content. Try installing Firefox."),window.history.back())}function SetFullscreen(e){if("undefined"==typeof JSEvents)return void console.log("Player not loaded yet.");var t=JSEvents.canPerformEventHandlerRequests;JSEvents.canPerformEventHandlerRequests=function(){return 1},Module.cwrap("SetFullscreen","void",["number"])(e),JSEvents.canPerformEventHandlerRequests=t}var CompressionState={Uninitialized:0,Pending:1,Unsupported:2,Supported:3,current:0,pendingServerRequests:[],Set:function(e){if(CompressionState.current==CompressionState.Pending){CompressionState.current=e;for(var t=0;t<CompressionState.pendingServerRequests.length;t++)CompressionState.pendingServerRequests[t]()}}};Module.memoryInitializerRequest={response:null,callback:null,addEventListener:function(e,t){if("load"!=e)throw"Unexpected type "+e;this.callback=t}},LoadCompressedJS(Module.codeUrl),LoadCompressedFile(Module.memUrl,function(e){Module.memoryInitializerRequest.response=e,Module.memoryInitializerRequest.callback&&Module.memoryInitializerRequest.callback()}),function(e){if("object"==typeof exports&&"undefined"!=typeof module)module.exports=e();else if("function"==typeof define&&define.amd)define([],e);else{var t;t="undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:this,t.pako=e()}}(function(){return function e(t,o,n){function a(r,s){if(!o[r]){if(!t[r]){var l="function"==typeof require&&require;if(!s&&l)return l(r,!0);if(i)return i(r,!0);var d=new Error("Cannot find module '"+r+"'");throw d.code="MODULE_NOT_FOUND",d}var u=o[r]={exports:{}};t[r][0].call(u.exports,function(e){var o=t[r][1][e];return a(o?o:e)},u,u.exports,e,t,o,n)}return o[r].exports}for(var i="function"==typeof require&&require,r=0;r<n.length;r++)a(n[r]);return a}({1:[function(e,t,o){"use strict";var n="undefined"!=typeof Uint8Array&&"undefined"!=typeof Uint16Array&&"undefined"!=typeof Int32Array;o.assign=function(e){for(var t=Array.prototype.slice.call(arguments,1);t.length;){var o=t.shift();if(o){if("object"!=typeof o)throw new TypeError(o+"must be non-object");for(var n in o)o.hasOwnProperty(n)&&(e[n]=o[n])}}return e},o.shrinkBuf=function(e,t){return e.length===t?e:e.subarray?e.subarray(0,t):(e.length=t,e)};var a={arraySet:function(e,t,o,n,a){if(t.subarray&&e.subarray)return void e.set(t.subarray(o,o+n),a);for(var i=0;n>i;i++)e[a+i]=t[o+i]},flattenChunks:function(e){var t,o,n,a,i,r;for(n=0,t=0,o=e.length;o>t;t++)n+=e[t].length;for(r=new Uint8Array(n),a=0,t=0,o=e.length;o>t;t++)i=e[t],r.set(i,a),a+=i.length;return r}},i={arraySet:function(e,t,o,n,a){for(var i=0;n>i;i++)e[a+i]=t[o+i]},flattenChunks:function(e){return[].concat.apply([],e)}};o.setTyped=function(e){e?(o.Buf8=Uint8Array,o.Buf16=Uint16Array,o.Buf32=Int32Array,o.assign(o,a)):(o.Buf8=Array,o.Buf16=Array,o.Buf32=Array,o.assign(o,i))},o.setTyped(n)},{}],2:[function(e,t,o){"use strict";function n(e,t){if(65537>t&&(e.subarray&&r||!e.subarray&&i))return String.fromCharCode.apply(null,a.shrinkBuf(e,t));for(var o="",n=0;t>n;n++)o+=String.fromCharCode(e[n]);return o}var a=e("./common"),i=!0,r=!0;try{String.fromCharCode.apply(null,[0])}catch(s){i=!1}try{String.fromCharCode.apply(null,new Uint8Array(1))}catch(s){r=!1}for(var l=new a.Buf8(256),d=0;256>d;d++)l[d]=d>=252?6:d>=248?5:d>=240?4:d>=224?3:d>=192?2:1;l[254]=l[254]=1,o.string2buf=function(e){var t,o,n,i,r,s=e.length,l=0;for(i=0;s>i;i++)o=e.charCodeAt(i),55296===(64512&o)&&s>i+1&&(n=e.charCodeAt(i+1),56320===(64512&n)&&(o=65536+(o-55296<<10)+(n-56320),i++)),l+=128>o?1:2048>o?2:65536>o?3:4;for(t=new a.Buf8(l),r=0,i=0;l>r;i++)o=e.charCodeAt(i),55296===(64512&o)&&s>i+1&&(n=e.charCodeAt(i+1),56320===(64512&n)&&(o=65536+(o-55296<<10)+(n-56320),i++)),128>o?t[r++]=o:2048>o?(t[r++]=192|o>>>6,t[r++]=128|63&o):65536>o?(t[r++]=224|o>>>12,t[r++]=128|o>>>6&63,t[r++]=128|63&o):(t[r++]=240|o>>>18,t[r++]=128|o>>>12&63,t[r++]=128|o>>>6&63,t[r++]=128|63&o);return t},o.buf2binstring=function(e){return n(e,e.length)},o.binstring2buf=function(e){for(var t=new a.Buf8(e.length),o=0,n=t.length;n>o;o++)t[o]=e.charCodeAt(o);return t},o.buf2string=function(e,t){var o,a,i,r,s=t||e.length,d=new Array(2*s);for(a=0,o=0;s>o;)if(i=e[o++],128>i)d[a++]=i;else if(r=l[i],r>4)d[a++]=65533,o+=r-1;else{for(i&=2===r?31:3===r?15:7;r>1&&s>o;)i=i<<6|63&e[o++],r--;r>1?d[a++]=65533:65536>i?d[a++]=i:(i-=65536,d[a++]=55296|i>>10&1023,d[a++]=56320|1023&i)}return n(d,a)},o.utf8border=function(e,t){var o;for(t=t||e.length,t>e.length&&(t=e.length),o=t-1;o>=0&&128===(192&e[o]);)o--;return 0>o?t:0===o?t:o+l[e[o]]>t?o:t}},{"./common":1}],3:[function(e,t,o){"use strict";function n(e,t,o,n){for(var a=65535&e|0,i=e>>>16&65535|0,r=0;0!==o;){r=o>2e3?2e3:o,o-=r;do a=a+t[n++]|0,i=i+a|0;while(--r);a%=65521,i%=65521}return a|i<<16|0}t.exports=n},{}],4:[function(e,t,o){t.exports={Z_NO_FLUSH:0,Z_PARTIAL_FLUSH:1,Z_SYNC_FLUSH:2,Z_FULL_FLUSH:3,Z_FINISH:4,Z_BLOCK:5,Z_TREES:6,Z_OK:0,Z_STREAM_END:1,Z_NEED_DICT:2,Z_ERRNO:-1,Z_STREAM_ERROR:-2,Z_DATA_ERROR:-3,Z_BUF_ERROR:-5,Z_NO_COMPRESSION:0,Z_BEST_SPEED:1,Z_BEST_COMPRESSION:9,Z_DEFAULT_COMPRESSION:-1,Z_FILTERED:1,Z_HUFFMAN_ONLY:2,Z_RLE:3,Z_FIXED:4,Z_DEFAULT_STRATEGY:0,Z_BINARY:0,Z_TEXT:1,Z_UNKNOWN:2,Z_DEFLATED:8}},{}],5:[function(e,t,o){"use strict";function n(){for(var e,t=[],o=0;256>o;o++){e=o;for(var n=0;8>n;n++)e=1&e?3988292384^e>>>1:e>>>1;t[o]=e}return t}function a(e,t,o,n){var a=i,r=n+o;e=-1^e;for(var s=n;r>s;s++)e=e>>>8^a[255&(e^t[s])];return-1^e}var i=n();t.exports=a},{}],6:[function(e,t,o){"use strict";function n(){this.text=0,this.time=0,this.xflags=0,this.os=0,this.extra=null,this.extra_len=0,this.name="",this.comment="",this.hcrc=0,this.done=!1}t.exports=n},{}],7:[function(e,t,o){"use strict";var n=30,a=12;t.exports=function(e,t){var o,i,r,s,l,d,u,c,f,h,p,m,b,w,g,v,k,y,_,x,S,M,C,E,R;o=e.state,i=e.next_in,E=e.input,r=i+(e.avail_in-5),s=e.next_out,R=e.output,l=s-(t-e.avail_out),d=s+(e.avail_out-257),u=o.dmax,c=o.wsize,f=o.whave,h=o.wnext,p=o.window,m=o.hold,b=o.bits,w=o.lencode,g=o.distcode,v=(1<<o.lenbits)-1,k=(1<<o.distbits)-1;e:do{15>b&&(m+=E[i++]<<b,b+=8,m+=E[i++]<<b,b+=8),y=w[m&v];t:for(;;){if(_=y>>>24,m>>>=_,b-=_,_=y>>>16&255,0===_)R[s++]=65535&y;else{if(!(16&_)){if(0===(64&_)){y=w[(65535&y)+(m&(1<<_)-1)];continue t}if(32&_){o.mode=a;break e}e.msg="invalid literal/length code",o.mode=n;break e}x=65535&y,_&=15,_&&(_>b&&(m+=E[i++]<<b,b+=8),x+=m&(1<<_)-1,m>>>=_,b-=_),15>b&&(m+=E[i++]<<b,b+=8,m+=E[i++]<<b,b+=8),y=g[m&k];o:for(;;){if(_=y>>>24,m>>>=_,b-=_,_=y>>>16&255,!(16&_)){if(0===(64&_)){y=g[(65535&y)+(m&(1<<_)-1)];continue o}e.msg="invalid distance code",o.mode=n;break e}if(S=65535&y,_&=15,_>b&&(m+=E[i++]<<b,b+=8,_>b&&(m+=E[i++]<<b,b+=8)),S+=m&(1<<_)-1,S>u){e.msg="invalid distance too far back",o.mode=n;break e}if(m>>>=_,b-=_,_=s-l,S>_){if(_=S-_,_>f&&o.sane){e.msg="invalid distance too far back",o.mode=n;break e}if(M=0,C=p,0===h){if(M+=c-_,x>_){x-=_;do R[s++]=p[M++];while(--_);M=s-S,C=R}}else if(_>h){if(M+=c+h-_,_-=h,x>_){x-=_;do R[s++]=p[M++];while(--_);if(M=0,x>h){_=h,x-=_;do R[s++]=p[M++];while(--_);M=s-S,C=R}}}else if(M+=h-_,x>_){x-=_;do R[s++]=p[M++];while(--_);M=s-S,C=R}for(;x>2;)R[s++]=C[M++],R[s++]=C[M++],R[s++]=C[M++],x-=3;x&&(R[s++]=C[M++],x>1&&(R[s++]=C[M++]))}else{M=s-S;do R[s++]=R[M++],R[s++]=R[M++],R[s++]=R[M++],x-=3;while(x>2);x&&(R[s++]=R[M++],x>1&&(R[s++]=R[M++]))}break}}break}}while(r>i&&d>s);x=b>>3,i-=x,b-=x<<3,m&=(1<<b)-1,e.next_in=i,e.next_out=s,e.avail_in=r>i?5+(r-i):5-(i-r),e.avail_out=d>s?257+(d-s):257-(s-d),o.hold=m,o.bits=b}},{}],8:[function(e,t,o){"use strict";function n(e){return(e>>>24&255)+(e>>>8&65280)+((65280&e)<<8)+((255&e)<<24)}function a(){this.mode=0,this.last=!1,this.wrap=0,this.havedict=!1,this.flags=0,this.dmax=0,this.check=0,this.total=0,this.head=null,this.wbits=0,this.wsize=0,this.whave=0,this.wnext=0,this.window=null,this.hold=0,this.bits=0,this.length=0,this.offset=0,this.extra=0,this.lencode=null,this.distcode=null,this.lenbits=0,this.distbits=0,this.ncode=0,this.nlen=0,this.ndist=0,this.have=0,this.next=null,this.lens=new w.Buf16(320),this.work=new w.Buf16(288),this.lendyn=null,this.distdyn=null,this.sane=0,this.back=0,this.was=0}function i(e){var t;return e&&e.state?(t=e.state,e.total_in=e.total_out=t.total=0,e.msg="",t.wrap&&(e.adler=1&t.wrap),t.mode=T,t.last=0,t.havedict=0,t.dmax=32768,t.head=null,t.hold=0,t.bits=0,t.lencode=t.lendyn=new w.Buf32(pe),t.distcode=t.distdyn=new w.Buf32(me),t.sane=1,t.back=-1,R):L}function r(e){var t;return e&&e.state?(t=e.state,t.wsize=0,t.whave=0,t.wnext=0,i(e)):L}function s(e,t){var o,n;return e&&e.state?(n=e.state,0>t?(o=0,t=-t):(o=(t>>4)+1,48>t&&(t&=15)),t&&(8>t||t>15)?L:(null!==n.window&&n.wbits!==t&&(n.window=null),n.wrap=o,n.wbits=t,r(e))):L}function l(e,t){var o,n;return e?(n=new a,e.state=n,n.window=null,o=s(e,t),o!==R&&(e.state=null),o):L}function d(e){return l(e,we)}function u(e){if(ge){var t;for(m=new w.Buf32(512),b=new w.Buf32(32),t=0;144>t;)e.lens[t++]=8;for(;256>t;)e.lens[t++]=9;for(;280>t;)e.lens[t++]=7;for(;288>t;)e.lens[t++]=8;for(y(x,e.lens,0,288,m,0,e.work,{bits:9}),t=0;32>t;)e.lens[t++]=5;y(S,e.lens,0,32,b,0,e.work,{bits:5}),ge=!1}e.lencode=m,e.lenbits=9,e.distcode=b,e.distbits=5}function c(e,t,o,n){var a,i=e.state;return null===i.window&&(i.wsize=1<<i.wbits,i.wnext=0,i.whave=0,i.window=new w.Buf8(i.wsize)),n>=i.wsize?(w.arraySet(i.window,t,o-i.wsize,i.wsize,0),i.wnext=0,i.whave=i.wsize):(a=i.wsize-i.wnext,a>n&&(a=n),w.arraySet(i.window,t,o-n,a,i.wnext),n-=a,n?(w.arraySet(i.window,t,o-n,n,0),i.wnext=n,i.whave=i.wsize):(i.wnext+=a,i.wnext===i.wsize&&(i.wnext=0),i.whave<i.wsize&&(i.whave+=a))),0}function f(e,t){var o,a,i,r,s,l,d,f,h,p,m,b,pe,me,be,we,ge,ve,ke,ye,_e,xe,Se,Me,Ce=0,Ee=new w.Buf8(4),Re=[16,17,18,0,8,7,9,6,10,5,11,4,12,3,13,2,14,1,15];if(!e||!e.state||!e.output||!e.input&&0!==e.avail_in)return L;o=e.state,o.mode===J&&(o.mode=K),s=e.next_out,i=e.output,d=e.avail_out,r=e.next_in,a=e.input,l=e.avail_in,f=o.hold,h=o.bits,p=l,m=d,xe=R;e:for(;;)switch(o.mode){case T:if(0===o.wrap){o.mode=K;break}for(;16>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}if(2&o.wrap&&35615===f){o.check=0,Ee[0]=255&f,Ee[1]=f>>>8&255,o.check=v(o.check,Ee,2,0),f=0,h=0,o.mode=U;break}if(o.flags=0,o.head&&(o.head.done=!1),!(1&o.wrap)||(((255&f)<<8)+(f>>8))%31){e.msg="incorrect header check",o.mode=ce;break}if((15&f)!==I){e.msg="unknown compression method",o.mode=ce;break}if(f>>>=4,h-=4,_e=(15&f)+8,0===o.wbits)o.wbits=_e;else if(_e>o.wbits){e.msg="invalid window size",o.mode=ce;break}o.dmax=1<<_e,e.adler=o.check=1,o.mode=512&f?H:J,f=0,h=0;break;case U:for(;16>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}if(o.flags=f,(255&o.flags)!==I){e.msg="unknown compression method",o.mode=ce;break}if(57344&o.flags){e.msg="unknown header flags set",o.mode=ce;break}o.head&&(o.head.text=f>>8&1),512&o.flags&&(Ee[0]=255&f,Ee[1]=f>>>8&255,o.check=v(o.check,Ee,2,0)),f=0,h=0,o.mode=O;case O:for(;32>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}o.head&&(o.head.time=f),512&o.flags&&(Ee[0]=255&f,Ee[1]=f>>>8&255,Ee[2]=f>>>16&255,Ee[3]=f>>>24&255,o.check=v(o.check,Ee,4,0)),f=0,h=0,o.mode=Z;case Z:for(;16>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}o.head&&(o.head.xflags=255&f,o.head.os=f>>8),512&o.flags&&(Ee[0]=255&f,Ee[1]=f>>>8&255,o.check=v(o.check,Ee,2,0)),f=0,h=0,o.mode=P;case P:if(1024&o.flags){for(;16>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}o.length=f,o.head&&(o.head.extra_len=f),512&o.flags&&(Ee[0]=255&f,Ee[1]=f>>>8&255,o.check=v(o.check,Ee,2,0)),f=0,h=0}else o.head&&(o.head.extra=null);o.mode=q;case q:if(1024&o.flags&&(b=o.length,b>l&&(b=l),b&&(o.head&&(_e=o.head.extra_len-o.length,o.head.extra||(o.head.extra=new Array(o.head.extra_len)),w.arraySet(o.head.extra,a,r,b,_e)),512&o.flags&&(o.check=v(o.check,a,b,r)),l-=b,r+=b,o.length-=b),o.length))break e;o.length=0,o.mode=G;case G:if(2048&o.flags){if(0===l)break e;b=0;do _e=a[r+b++],o.head&&_e&&o.length<65536&&(o.head.name+=String.fromCharCode(_e));while(_e&&l>b);if(512&o.flags&&(o.check=v(o.check,a,b,r)),l-=b,r+=b,_e)break e}else o.head&&(o.head.name=null);o.length=0,o.mode=N;case N:if(4096&o.flags){if(0===l)break e;b=0;do _e=a[r+b++],o.head&&_e&&o.length<65536&&(o.head.comment+=String.fromCharCode(_e));while(_e&&l>b);if(512&o.flags&&(o.check=v(o.check,a,b,r)),l-=b,r+=b,_e)break e}else o.head&&(o.head.comment=null);o.mode=j;case j:if(512&o.flags){for(;16>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}if(f!==(65535&o.check)){e.msg="header crc mismatch",o.mode=ce;break}f=0,h=0}o.head&&(o.head.hcrc=o.flags>>9&1,o.head.done=!0),e.adler=o.check=0,o.mode=J;break;case H:for(;32>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}e.adler=o.check=n(f),f=0,h=0,o.mode=W;case W:if(0===o.havedict)return e.next_out=s,e.avail_out=d,e.next_in=r,e.avail_in=l,o.hold=f,o.bits=h,D;e.adler=o.check=1,o.mode=J;case J:if(t===C||t===E)break e;case K:if(o.last){f>>>=7&h,h-=7&h,o.mode=le;break}for(;3>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}switch(o.last=1&f,f>>>=1,h-=1,3&f){case 0:o.mode=Y;break;case 1:if(u(o),o.mode=te,t===E){f>>>=2,h-=2;break e}break;case 2:o.mode=Q;break;case 3:e.msg="invalid block type",o.mode=ce}f>>>=2,h-=2;break;case Y:for(f>>>=7&h,h-=7&h;32>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}if((65535&f)!==(f>>>16^65535)){e.msg="invalid stored block lengths",o.mode=ce;break}if(o.length=65535&f,f=0,h=0,o.mode=X,t===E)break e;case X:o.mode=V;case V:if(b=o.length){if(b>l&&(b=l),b>d&&(b=d),0===b)break e;w.arraySet(i,a,r,b,s),l-=b,r+=b,d-=b,s+=b,o.length-=b;break}o.mode=J;break;case Q:for(;14>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}if(o.nlen=(31&f)+257,f>>>=5,h-=5,o.ndist=(31&f)+1,f>>>=5,h-=5,o.ncode=(15&f)+4,f>>>=4,h-=4,o.nlen>286||o.ndist>30){e.msg="too many length or distance symbols",o.mode=ce;break}o.have=0,o.mode=$;case $:for(;o.have<o.ncode;){for(;3>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}o.lens[Re[o.have++]]=7&f,f>>>=3,h-=3}for(;o.have<19;)o.lens[Re[o.have++]]=0;if(o.lencode=o.lendyn,o.lenbits=7,Se={bits:o.lenbits},xe=y(_,o.lens,0,19,o.lencode,0,o.work,Se),o.lenbits=Se.bits,xe){e.msg="invalid code lengths set",o.mode=ce;break}o.have=0,o.mode=ee;case ee:for(;o.have<o.nlen+o.ndist;){for(;Ce=o.lencode[f&(1<<o.lenbits)-1],be=Ce>>>24,we=Ce>>>16&255,ge=65535&Ce,!(h>=be);){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}if(16>ge)f>>>=be,h-=be,o.lens[o.have++]=ge;else{if(16===ge){for(Me=be+2;Me>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}if(f>>>=be,h-=be,0===o.have){e.msg="invalid bit length repeat",o.mode=ce;break}_e=o.lens[o.have-1],b=3+(3&f),f>>>=2,h-=2}else if(17===ge){for(Me=be+3;Me>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}f>>>=be,h-=be,_e=0,b=3+(7&f),f>>>=3,h-=3}else{for(Me=be+7;Me>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}f>>>=be,h-=be,_e=0,b=11+(127&f),f>>>=7,h-=7}if(o.have+b>o.nlen+o.ndist){e.msg="invalid bit length repeat",o.mode=ce;break}for(;b--;)o.lens[o.have++]=_e}}if(o.mode===ce)break;if(0===o.lens[256]){e.msg="invalid code -- missing end-of-block",o.mode=ce;break}if(o.lenbits=9,Se={bits:o.lenbits},xe=y(x,o.lens,0,o.nlen,o.lencode,0,o.work,Se),o.lenbits=Se.bits,xe){e.msg="invalid literal/lengths set",o.mode=ce;break}if(o.distbits=6,o.distcode=o.distdyn,Se={bits:o.distbits},xe=y(S,o.lens,o.nlen,o.ndist,o.distcode,0,o.work,Se),o.distbits=Se.bits,xe){e.msg="invalid distances set",o.mode=ce;break}if(o.mode=te,t===E)break e;case te:o.mode=oe;case oe:if(l>=6&&d>=258){e.next_out=s,e.avail_out=d,e.next_in=r,e.avail_in=l,o.hold=f,o.bits=h,k(e,m),s=e.next_out,i=e.output,d=e.avail_out,r=e.next_in,a=e.input,l=e.avail_in,f=o.hold,h=o.bits,o.mode===J&&(o.back=-1);break}for(o.back=0;Ce=o.lencode[f&(1<<o.lenbits)-1],be=Ce>>>24,we=Ce>>>16&255,ge=65535&Ce,!(h>=be);){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}if(we&&0===(240&we)){for(ve=be,ke=we,ye=ge;Ce=o.lencode[ye+((f&(1<<ve+ke)-1)>>ve)],be=Ce>>>24,we=Ce>>>16&255,ge=65535&Ce,!(h>=ve+be);){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}f>>>=ve,h-=ve,o.back+=ve}if(f>>>=be,h-=be,o.back+=be,o.length=ge,0===we){o.mode=se;break}if(32&we){o.back=-1,o.mode=J;break}if(64&we){e.msg="invalid literal/length code",o.mode=ce;break}o.extra=15&we,o.mode=ne;case ne:if(o.extra){for(Me=o.extra;Me>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}o.length+=f&(1<<o.extra)-1,f>>>=o.extra,h-=o.extra,o.back+=o.extra}o.was=o.length,o.mode=ae;case ae:for(;Ce=o.distcode[f&(1<<o.distbits)-1],be=Ce>>>24,we=Ce>>>16&255,ge=65535&Ce,!(h>=be);){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}if(0===(240&we)){for(ve=be,ke=we,ye=ge;Ce=o.distcode[ye+((f&(1<<ve+ke)-1)>>ve)],be=Ce>>>24,we=Ce>>>16&255,ge=65535&Ce,!(h>=ve+be);){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}f>>>=ve,h-=ve,o.back+=ve}if(f>>>=be,h-=be,o.back+=be,64&we){e.msg="invalid distance code",o.mode=ce;break}o.offset=ge,o.extra=15&we,o.mode=ie;case ie:if(o.extra){for(Me=o.extra;Me>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}o.offset+=f&(1<<o.extra)-1,f>>>=o.extra,h-=o.extra,o.back+=o.extra}if(o.offset>o.dmax){e.msg="invalid distance too far back",o.mode=ce;break}o.mode=re;case re:if(0===d)break e;if(b=m-d,o.offset>b){if(b=o.offset-b,b>o.whave&&o.sane){e.msg="invalid distance too far back",o.mode=ce;break}b>o.wnext?(b-=o.wnext,pe=o.wsize-b):pe=o.wnext-b,b>o.length&&(b=o.length),me=o.window}else me=i,pe=s-o.offset,b=o.length;b>d&&(b=d),d-=b,o.length-=b;do i[s++]=me[pe++];while(--b);0===o.length&&(o.mode=oe);break;case se:if(0===d)break e;i[s++]=o.length,d--,o.mode=oe;break;case le:if(o.wrap){for(;32>h;){if(0===l)break e;l--,f|=a[r++]<<h,h+=8}if(m-=d,e.total_out+=m,o.total+=m,m&&(e.adler=o.check=o.flags?v(o.check,i,m,s-m):g(o.check,i,m,s-m)),m=d,(o.flags?f:n(f))!==o.check){e.msg="incorrect data check",o.mode=ce;break}f=0,h=0}o.mode=de;case de:if(o.wrap&&o.flags){for(;32>h;){if(0===l)break e;l--,f+=a[r++]<<h,h+=8}if(f!==(4294967295&o.total)){e.msg="incorrect length check",o.mode=ce;break}f=0,h=0}o.mode=ue;case ue:xe=F;break e;case ce:xe=A;break e;case fe:return z;case he:default:return L}return e.next_out=s,e.avail_out=d,e.next_in=r,e.avail_in=l,o.hold=f,o.bits=h,(o.wsize||m!==e.avail_out&&o.mode<ce&&(o.mode<le||t!==M))&&c(e,e.output,e.next_out,m-e.avail_out)?(o.mode=fe,z):(p-=e.avail_in,m-=e.avail_out,e.total_in+=p,e.total_out+=m,o.total+=m,o.wrap&&m&&(e.adler=o.check=o.flags?v(o.check,i,m,e.next_out-m):g(o.check,i,m,e.next_out-m)),e.data_type=o.bits+(o.last?64:0)+(o.mode===J?128:0)+(o.mode===te||o.mode===X?256:0),(0===p&&0===m||t===M)&&xe===R&&(xe=B),xe)}function h(e){if(!e||!e.state)return L;var t=e.state;return t.window&&(t.window=null),e.state=null,R}function p(e,t){var o;return e&&e.state?(o=e.state,0===(2&o.wrap)?L:(o.head=t,t.done=!1,R)):L}var m,b,w=e("../utils/common"),g=e("./adler32"),v=e("./crc32"),k=e("./inffast"),y=e("./inftrees"),_=0,x=1,S=2,M=4,C=5,E=6,R=0,F=1,D=2,L=-2,A=-3,z=-4,B=-5,I=8,T=1,U=2,O=3,Z=4,P=5,q=6,G=7,N=8,j=9,H=10,W=11,J=12,K=13,Y=14,X=15,V=16,Q=17,$=18,ee=19,te=20,oe=21,ne=22,ae=23,ie=24,re=25,se=26,le=27,de=28,ue=29,ce=30,fe=31,he=32,pe=852,me=592,be=15,we=be,ge=!0;o.inflateReset=r,o.inflateReset2=s,o.inflateResetKeep=i,o.inflateInit=d,o.inflateInit2=l,o.inflate=f,o.inflateEnd=h,o.inflateGetHeader=p,o.inflateInfo="pako inflate (from Nodeca project)"},{"../utils/common":1,"./adler32":3,"./crc32":5,"./inffast":7,"./inftrees":9}],9:[function(e,t,o){"use strict";var n=e("../utils/common"),a=15,i=852,r=592,s=0,l=1,d=2,u=[3,4,5,6,7,8,9,10,11,13,15,17,19,23,27,31,35,43,51,59,67,83,99,115,131,163,195,227,258,0,0],c=[16,16,16,16,16,16,16,16,17,17,17,17,18,18,18,18,19,19,19,19,20,20,20,20,21,21,21,21,16,72,78],f=[1,2,3,4,5,7,9,13,17,25,33,49,65,97,129,193,257,385,513,769,1025,1537,2049,3073,4097,6145,8193,12289,16385,24577,0,0],h=[16,16,16,16,17,17,18,18,19,19,20,20,21,21,22,22,23,23,24,24,25,25,26,26,27,27,28,28,29,29,64,64];t.exports=function(e,t,o,p,m,b,w,g){var v,k,y,_,x,S,M,C,E,R=g.bits,F=0,D=0,L=0,A=0,z=0,B=0,I=0,T=0,U=0,O=0,Z=null,P=0,q=new n.Buf16(a+1),G=new n.Buf16(a+1),N=null,j=0;for(F=0;a>=F;F++)q[F]=0;for(D=0;p>D;D++)q[t[o+D]]++;for(z=R,A=a;A>=1&&0===q[A];A--);if(z>A&&(z=A),0===A)return m[b++]=20971520,m[b++]=20971520,g.bits=1,0;for(L=1;A>L&&0===q[L];L++);for(L>z&&(z=L),T=1,F=1;a>=F;F++)if(T<<=1,T-=q[F],0>T)return-1;if(T>0&&(e===s||1!==A))return-1;for(G[1]=0,F=1;a>F;F++)G[F+1]=G[F]+q[F];for(D=0;p>D;D++)0!==t[o+D]&&(w[G[t[o+D]]++]=D);if(e===s?(Z=N=w,S=19):e===l?(Z=u,P-=257,N=c,j-=257,S=256):(Z=f,N=h,S=-1),O=0,D=0,F=L,x=b,B=z,I=0,y=-1,U=1<<z,_=U-1,e===l&&U>i||e===d&&U>r)return 1;for(var H=0;;){H++,M=F-I,w[D]<S?(C=0,E=w[D]):w[D]>S?(C=N[j+w[D]],E=Z[P+w[D]]):(C=96,E=0),v=1<<F-I,k=1<<B,L=k;do k-=v,m[x+(O>>I)+k]=M<<24|C<<16|E|0;while(0!==k);for(v=1<<F-1;O&v;)v>>=1;if(0!==v?(O&=v-1,O+=v):O=0,D++,0===--q[F]){if(F===A)break;F=t[o+w[D]]}if(F>z&&(O&_)!==y){for(0===I&&(I=z),x+=L,B=F-I,T=1<<B;A>B+I&&(T-=q[B+I],!(0>=T));)B++,T<<=1;if(U+=1<<B,e===l&&U>i||e===d&&U>r)return 1;y=O&_,m[y]=z<<24|B<<16|x-b|0}}return 0!==O&&(m[x+O]=F-I<<24|64<<16|0),g.bits=z,0}},{"../utils/common":1}],10:[function(e,t,o){"use strict";t.exports={2:"need dictionary",1:"stream end",0:"","-1":"file error","-2":"stream error","-3":"data error","-4":"insufficient memory","-5":"buffer error","-6":"incompatible version"}},{}],11:[function(e,t,o){"use strict";function n(){this.input=null,this.next_in=0,this.avail_in=0,this.total_in=0,this.output=null,this.next_out=0,this.avail_out=0,this.total_out=0,this.msg="",this.state=null,this.data_type=2,this.adler=0}t.exports=n},{}],"/lib/inflate.js":[function(e,t,o){"use strict";function n(e,t){var o=new h(t);if(o.push(e,!0),o.err)throw o.msg;return o.result}function a(e,t){return t=t||{},t.raw=!0,n(e,t)}var i=e("./zlib/inflate.js"),r=e("./utils/common"),s=e("./utils/strings"),l=e("./zlib/constants"),d=e("./zlib/messages"),u=e("./zlib/zstream"),c=e("./zlib/gzheader"),f=Object.prototype.toString,h=function(e){this.options=r.assign({chunkSize:16384,windowBits:0,to:""},e||{});var t=this.options;t.raw&&t.windowBits>=0&&t.windowBits<16&&(t.windowBits=-t.windowBits,0===t.windowBits&&(t.windowBits=-15)),!(t.windowBits>=0&&t.windowBits<16)||e&&e.windowBits||(t.windowBits+=32),t.windowBits>15&&t.windowBits<48&&0===(15&t.windowBits)&&(t.windowBits|=15),this.err=0,this.msg="",this.ended=!1,this.chunks=[],this.strm=new u,this.strm.avail_out=0;var o=i.inflateInit2(this.strm,t.windowBits);if(o!==l.Z_OK)throw new Error(d[o]);this.header=new c,i.inflateGetHeader(this.strm,this.header)};h.prototype.push=function(e,t){var o,n,a,d,u,c=this.strm,h=this.options.chunkSize;if(this.ended)return!1;n=t===~~t?t:t===!0?l.Z_FINISH:l.Z_NO_FLUSH,"string"==typeof e?c.input=s.binstring2buf(e):"[object ArrayBuffer]"===f.call(e)?c.input=new Uint8Array(e):c.input=e,c.next_in=0,c.avail_in=c.input.length;do{if(0===c.avail_out&&(c.output=new r.Buf8(h),c.next_out=0,c.avail_out=h),o=i.inflate(c,l.Z_NO_FLUSH),o!==l.Z_STREAM_END&&o!==l.Z_OK)return this.onEnd(o),this.ended=!0,!1;c.next_out&&(0===c.avail_out||o===l.Z_STREAM_END||0===c.avail_in&&(n===l.Z_FINISH||n===l.Z_SYNC_FLUSH))&&("string"===this.options.to?(a=s.utf8border(c.output,c.next_out),d=c.next_out-a,u=s.buf2string(c.output,a),c.next_out=d,c.avail_out=h-d,d&&r.arraySet(c.output,c.output,a,d,0),this.onData(u)):this.onData(r.shrinkBuf(c.output,c.next_out)))}while(c.avail_in>0&&o!==l.Z_STREAM_END);return o===l.Z_STREAM_END&&(n=l.Z_FINISH),n===l.Z_FINISH?(o=i.inflateEnd(this.strm),this.onEnd(o),this.ended=!0,o===l.Z_OK):n===l.Z_SYNC_FLUSH?(this.onEnd(l.Z_OK),c.avail_out=0,!0):!0},h.prototype.onData=function(e){this.chunks.push(e)},h.prototype.onEnd=function(e){e===l.Z_OK&&("string"===this.options.to?this.result=this.chunks.join(""):this.result=r.flattenChunks(this.chunks)),this.chunks=[],this.err=e,this.msg=this.strm.msg},o.Inflate=h,o.inflate=n,o.inflateRaw=a,o.ungzip=n},{"./utils/common":1,"./utils/strings":2,"./zlib/constants":4,"./zlib/gzheader":6,"./zlib/inflate.js":8,"./zlib/messages":10,"./zlib/zstream":11}]},{},[])("/lib/inflate.js")});var browser=function(){var e,t=navigator.userAgent,o=t.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i)||[];return/trident/i.test(o[1])?(e=/\brv[ :]+(\d+)/g.exec(t)||[],"IE "+(e[1]||"")):"Chrome"===o[1]&&(e=t.match(/\bOPR\/(\d+)/),null!=e)?"Opera "+e[1]:(o=o[2]?[o[1],o[2]]:[navigator.appName,navigator.appVersion,"-?"],null!=(e=t.match(/version\/(\d+)/i))&&o.splice(1,1,e[1]),o.join(" "))}(),hasWebGL=function(){if(!window.WebGLRenderingContext)return 0;var e=document.createElement("canvas"),t=e.getContext("webgl");return t||(t=e.getContext("experimental-webgl"))?1:0}(),mobile=function(e){return/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(e)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(e.substr(0,4))}(navigator.userAgent||navigator.vendor||window.opera);Module.compatibilitycheck?Module.compatibilitycheck():CompatibilityCheck();var didShowErrorMessage=!1;"function"!=typeof window.onerror&&(window.onerror=function(e,t,o){return Module.errorhandler&&Module.errorhandler(e,t,o)||(console.log("Invoking error handler due to\n"+e),"function"==typeof dump&&dump("Invoking error handler due to\n"+e),didShowErrorMessage||-1!=e.indexOf("UnknownError")||-1!=e.indexOf("Program terminated with exit(0)"))?void 0:(didShowErrorMessage=!0,-1!=e.indexOf("DISABLE_EXCEPTION_CATCHING")?void alert("An exception has occured, but exception handling has been disabled in this build. If you are the developer of this content, enable exceptions in your project's WebGL player settings to be able to catch the exception or see the stack trace."):-1!=e.indexOf("Cannot enlarge memory arrays")?void alert("Out of memory. If you are the developer of this content, try allocating more memory to your WebGL build in the WebGL player settings."):-1!=e.indexOf("Invalid array buffer length")||-1!=e.indexOf("out of memory")?void alert("The browser could not allocate enough memory for the WebGL content. If you are the developer of this content, try allocating less memory to your WebGL build in the WebGL player settings."):-1!=e.indexOf("Script error.")&&0==document.URL.indexOf("file:")?void alert("It seems your browser does not support running Unity WebGL content from file:// urls. Please upload it to an http server, or try a different browser."):void alert("An error occured running the Unity content on this page. See your browser's JavaScript console for more info. The error was:\n"+e))}),Module.locateFile=function(e){return Module.dataUrl},Module.preRun=[],Module.postRun=[],Module.print=function(){return function(e){console.log(e)}}(),Module.printErr=function(e){console.error(e)},Module.canvas=document.getElementById("canvas"),Module.progress=null,Module.setStatus=function(e){if(null==this.progress){if("function"!=typeof UnityProgress)return;this.progress=new UnityProgress(canvas)}if(Module.setStatus.last||(Module.setStatus.last={time:Date.now(),text:""}),e!==Module.setStatus.text){this.progress.SetMessage(e);var t=e.match(/([^(]+)\((\d+(\.\d+)?)\/(\d+)\)/);t&&this.progress.SetProgress(parseInt(t[2])/parseInt(t[4])),""===e&&this.progress.Clear()}},Module.totalDependencies=0,Module.monitorRunDependencies=function(e){this.totalDependencies=Math.max(this.totalDependencies,e),Module.setStatus(e?"Preparing... ("+(this.totalDependencies-e)+"/"+this.totalDependencies+")":"All downloads complete.");
},Module.setStatus("Downloading (0.0/1)");var Module;"undefined"==typeof Module&&(Module=eval("(function() { try { return Module || {} } catch(e) { return {} } })()")),Module.expectedDataFileDownloads||(Module.expectedDataFileDownloads=0,Module.finishedDataFileDownloads=0),Module.expectedDataFileDownloads++,function(){var e=function(e){function t(e){console.error("package error:",e)}function o(){function e(e,t){if(!e)throw t+(new Error).stack}function t(e,t,o,n){this.start=e,this.end=t,this.crunched=o,this.audio=n}function o(o){Module.finishedDataFileDownloads++,e(o,"Loading data file failed.");var n=new Uint8Array(o);t.prototype.byteArray=n,t.prototype.requests["/globalgamemanagers"].onload(),t.prototype.requests["/globalgamemanagers.assets"].onload(),t.prototype.requests["/level0"].onload(),t.prototype.requests["/level1"].onload(),t.prototype.requests["/methods_pointedto_by_uievents.xml"].onload(),t.prototype.requests["/preserved_derived_types.xml"].onload(),t.prototype.requests["/resources.assets"].onload(),t.prototype.requests["/resources.resource"].onload(),t.prototype.requests["/sharedassets0.assets"].onload(),t.prototype.requests["/sharedassets1.assets"].onload(),t.prototype.requests["/Il2CppData/Metadata/global-metadata.dat"].onload(),t.prototype.requests["/Resources/unity_default_resources"].onload(),t.prototype.requests["/Resources/unity_builtin_extra"].onload(),t.prototype.requests["/Managed/mono/2.0/machine.config"].onload(),Module.removeRunDependency("datafile_Slot_WebGL.data")}Module.FS_createPath("/","Il2CppData",!0,!0),Module.FS_createPath("/Il2CppData","Metadata",!0,!0),Module.FS_createPath("/","Resources",!0,!0),Module.FS_createPath("/","Managed",!0,!0),Module.FS_createPath("/Managed","mono",!0,!0),Module.FS_createPath("/Managed/mono","2.0",!0,!0),t.prototype={requests:{},open:function(e,t){this.name=t,this.requests[t]=this,Module.addRunDependency("fp "+this.name)},send:function(){},onload:function(){var e=this.byteArray.subarray(this.start,this.end);this.finish(e)},finish:function(e){var t=this;Module.FS_createPreloadedFile(this.name,null,e,!0,!0,function(){Module.removeRunDependency("fp "+t.name)},function(){t.audio?Module.removeRunDependency("fp "+t.name):Module.printErr("Preloading file "+t.name+" failed")},!1,!0),this.requests[this.name]=null}},new t(0,24796,0,0).open("GET","/globalgamemanagers"),new t(24796,44300,0,0).open("GET","/globalgamemanagers.assets"),new t(44300,297984,0,0).open("GET","/level0"),new t(297984,1286820,0,0).open("GET","/level1"),new t(1286820,1292766,0,0).open("GET","/methods_pointedto_by_uievents.xml"),new t(1292766,1298993,0,0).open("GET","/preserved_derived_types.xml"),new t(1298993,1305373,0,0).open("GET","/resources.assets"),new t(1305373,2287592,0,0).open("GET","/resources.resource"),new t(2287592,11108844,0,0).open("GET","/sharedassets0.assets"),new t(11108844,30400600,0,0).open("GET","/sharedassets1.assets"),new t(30400600,33817192,0,0).open("GET","/Il2CppData/Metadata/global-metadata.dat"),new t(33817192,35314564,0,0).open("GET","/Resources/unity_default_resources"),new t(35314564,35375292,0,0).open("GET","/Resources/unity_builtin_extra"),new t(35375292,35402917,0,0).open("GET","/Managed/mono/2.0/machine.config"),Module.addRunDependency("datafile_Slot_WebGL.data"),Module.preloadResults||(Module.preloadResults={}),Module.preloadResults[a]={fromCache:!1},l?(o(l),l=null):d=o}var n;if("object"==typeof window)n=window.encodeURIComponent(window.location.pathname.toString().substring(0,window.location.pathname.toString().lastIndexOf("/"))+"/");else{if("undefined"==typeof location)throw"using preloaded data can only be done on a web page or in a web worker";n=encodeURIComponent(location.pathname.toString().substring(0,location.pathname.toString().lastIndexOf("/"))+"/")}var a="Slot_WebGL.data",i="Slot_WebGL.data";"function"!=typeof Module.locateFilePackage||Module.locateFile||(Module.locateFile=Module.locateFilePackage,Module.printErr("warning: you defined Module.locateFilePackage, that has been renamed to Module.locateFile (using your locateFilePackage for now)"));var r="function"==typeof Module.locateFile?Module.locateFile(i):(Module.filePackagePrefixURL||"")+i,s=35402917,l=null,d=null;fetchRemotePackageWrapper(r,s,function(e){d?(d(e),d=null):l=e},t),Module.calledRun?o():(Module.preRun||(Module.preRun=[]),Module.preRun.push(o))};e()}();