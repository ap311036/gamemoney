var _change=0,_staying=0,show_relation_lines=true;$(document).ready(function(){$(window).bind("beforeunload",function(){if(_change==1&&_staying==0)return PMA_messages.strLeavingDesigner;else if(_change==1&&_staying==1)_staying=0});$(window).unload(function(){_change=0});window.top.onbeforeunload=function(){if(_change==1&&_staying==0){_staying=1;setTimeout("make_zero();",100);return PMA_messages.strLeavingDesigner}}});function make_zero(){_staying=0}
var dx,dy,dy2,cur_click,sm_x=2,sm_y=2,sm_s=0,sm_add=10,s_left=0,s_right=0,ON_relation=0,ON_grid=0,ON_display_field=0,ON_angular_direct=1,click_field=0,link_relation="",id_hint,canvas_width=0,canvas_height=0,osn_tab_width=0,osn_tab_height=0,height_field=7,Glob_X,Glob_Y,timeoutID,layer_menu_cur_click=0,step=10,old_class,from_array=[],downer;document.onmousedown=MouseDown;document.onmouseup=MouseUp;document.onmousemove=MouseMove;
var isIE=document.all&&!window.opera,isNN=!document.all&&document.getElementById,isN4=document.layers;if(isIE){window.onscroll=General_scroll;document.onselectstart=function(){return false}}
function MouseDown(a){var b,c;if(cur_click!=null){b=isIE?event.clientX+document.body.scrollLeft:a.pageX;c=isIE?event.clientY+document.body.scrollTop:a.pageY;dx=b-parseInt(cur_click.style.left);dy=c-parseInt(cur_click.style.top);document.getElementById("canvas").style.display="none";cur_click.style.zIndex=2}if(layer_menu_cur_click){b=a.pageX;dx=b-parseInt(document.getElementById("layer_menu").style.width)}}
function MouseMove(a){Glob_X=isIE?event.clientX+document.body.scrollLeft:a.pageX;Glob_Y=isIE?event.clientY+document.body.scrollTop:a.pageY;if(cur_click!=null){_change=1;a=Glob_X-dx;var b=Glob_Y-dy;a=a>0?a:0;b=b>0?b:0;if(ON_grid){a=a%step<step/2?a-a%step:a-a%step+step;b=b%step<step/2?b-b%step:b-b%step+step}cur_click.style.left=a+"px";cur_click.style.top=b+"px"}if(ON_relation||ON_display_field){document.getElementById("pmd_hint").style.left=Glob_X+20+"px";document.getElementById("pmd_hint").style.top=
Glob_Y+20+"px"}if(layer_menu_cur_click)document.getElementById("layer_menu").style.width=(Glob_X-dx>=150?Glob_X-dx:150)+"px"}function MouseUp(){if(cur_click!=null){document.getElementById("canvas").style.display="inline-block";Re_load();cur_click.style.zIndex=1;cur_click=null}layer_menu_cur_click=0}
function Canvas_pos(){canvas_width=document.getElementById("canvas").width=osn_tab_width-3;canvas_height=document.getElementById("canvas").height=osn_tab_height-3;if(isIE){document.getElementById("canvas").style.width=(osn_tab_width-3?osn_tab_width-3:0)+"px";document.getElementById("canvas").style.height=(osn_tab_height-3?osn_tab_height-3:0)+"px"}}
function Osn_tab_pos(){osn_tab_width=parseInt(document.getElementById("osn_tab").style.width);osn_tab_height=parseInt(document.getElementById("osn_tab").style.height)}function Main(){document.getElementById("layer_menu").style.top="-1000px";sm_x+=document.getElementById("osn_tab").offsetLeft;sm_y+=document.getElementById("osn_tab").offsetTop;Osn_tab_pos();Canvas_pos();Small_tab_refresh();Re_load();id_hint=document.getElementById("pmd_hint");isIE&&General_scroll()}
function Rezize_osn_tab(){var a=0,b=0;for(key in j_tabs){var c=parseInt(document.getElementById(key).style.left)+document.getElementById(key).offsetWidth,d=parseInt(document.getElementById(key).style.top)+document.getElementById(key).offsetHeight;a=a<c?c:a;b=b<d?d:b}osn_tab_width=a+50;osn_tab_height=b+50;Canvas_pos();document.getElementById("osn_tab").style.width=osn_tab_width+"px";document.getElementById("osn_tab").style.height=osn_tab_height+"px"}
function Re_load(){Rezize_osn_tab();var a,b,c,d=[];Clear();for(K in contr)for(key in contr[K])for(key2 in contr[K][key])for(key3 in contr[K][key][key2])if(document.getElementById("check_vis_"+key2).checked&&document.getElementById("check_vis_"+contr[K][key][key2][key3][0]).checked){var g=document.getElementById(key2).offsetLeft+1,f=g+document.getElementById(key2).offsetWidth,h=document.getElementById(contr[K][key][key2][key3][0]).offsetLeft,n=h+document.getElementById(contr[K][key][key2][key3][0]).offsetWidth;
d[0]=Math.abs(g-h);d[1]=Math.abs(g-n);d[2]=Math.abs(f-h);d[3]=Math.abs(f-n);a=s_left=s_right=0;for(var j=1;j<4;j++)if(d[a]>d[j])a=j;if(a==1){b=g-sm_s;c=n+sm_s;if(b<c)a=0}if(a==2){b=f+sm_s;c=h-sm_s;if(b>c)a=0}if(a==3){b=f+sm_s;c=n+sm_s;s_right=1}if(a==0){b=g-sm_s;c=h-sm_s;s_left=1}g=0;f=document.getElementById("id_hide_tbody_"+key2);if(f.innerHTML=="v")g=document.getElementById(key2+"."+key3).offsetTop;a=document.getElementById(key2).offsetTop+g+height_field;g=0;f=document.getElementById("id_hide_tbody_"+
contr[K][key][key2][key3][0]);if(f.innerHTML=="v")g=document.getElementById(contr[K][key][key2][key3][0]+"."+contr[K][key][key2][key3][1]).offsetTop;g=document.getElementById(contr[K][key][key2][key3][0]).offsetTop+g+height_field;Line0(b-sm_x,a-sm_y,c-sm_x,g-sm_y,getColorByTarget(contr[K][key][key2][key3][0]+"."+contr[K][key][key2][key3][1]))}}
function Line(a,b,c,d,g){var f=document.getElementById("canvas").getContext("2d");f.strokeStyle=g;f.lineWidth=1;f.beginPath();f.moveTo(a,b);f.lineTo(c,d);f.stroke()}function Line0(a,b,c,d,g){if(show_relation_lines){Circle(a,b,3,3,g);Rect(c-1,d-2,4,4,g);ON_angular_direct?Line2(a,b,c,d,g):Line3(a,b,c,d,g)}}
function Line2(a,b,c,d,g){var f=a,h=c;if(s_right){f+=sm_add;h+=sm_add}else if(s_left){f-=sm_add;h-=sm_add}else if(a<c){f+=sm_add;h-=sm_add}else{f-=sm_add;h+=sm_add}Line(a,b,f,b,g);Line(c,d,h,d,g);Line(f,b,h,d,g)}
function Line3(a,b,c,d,g){var f=a,h=c;if(s_right){if(a<c){f+=c-a+sm_add;h+=sm_add}else{h+=a-c+sm_add;f+=sm_add}Line(a,b,f,b,g);Line(c,d,h,d,g);Line(f,b,h,d,g)}else if(s_left){if(a<c){h-=c-a+sm_add;f-=sm_add}else{f-=a-c+sm_add;h-=sm_add}Line(a,b,f,b,g);Line(c,d,h,d,g);Line(f,b,h,d,g)}else{f=(a+c)/2;Line(a,b,f,b,g);Line(f,d,c,d,g);Line(f,b,f,d,g)}}
function Circle(a,b,c,d,g){var f=document.getElementById("canvas").getContext("2d");f.beginPath();f.moveTo(a,b);f.lineWidth=d;f.strokeStyle=g;f.arc(a,b,c,0,2*Math.PI,true);f.stroke()}function Clear(){document.getElementById("canvas").getContext("2d").clearRect(0,0,canvas_width,canvas_height)}function Rect(a,b,c,d,g){var f=document.getElementById("canvas").getContext("2d");f.fillStyle=g;f.fillRect(a,b,c,d)}
function Save(a){for(key in j_tabs){document.getElementById("t_x_"+key+"_").value=parseInt(document.getElementById(key).style.left);document.getElementById("t_y_"+key+"_").value=parseInt(document.getElementById(key).style.top);document.getElementById("t_v_"+key+"_").value=document.getElementById("id_tbody_"+key).style.display=="none"?0:1;document.getElementById("t_h_"+key+"_").value=document.getElementById("check_vis_"+key).checked?1:0}document.form1.action=a;document.form1.submit()}
function Get_url_pos(){var a="";for(key in j_tabs){a+="&t_x["+key+"]="+parseInt(document.getElementById(key).style.left);a+="&t_y["+key+"]="+parseInt(document.getElementById(key).style.top);a+="&t_v["+key+"]="+(document.getElementById("id_tbody_"+key).style.display=="none"?0:1);a+="&t_h["+key+"]="+(document.getElementById("check_vis_"+key).checked?1:0)}return a}
function Save2(){_change=0;var a="IS_AJAX=1&server="+server+"&db="+db+"&token="+token+"&die_save_pos=1";a+=Get_url_pos();makeRequest("pmd_save_pos.php",a)}function Grid(){if(ON_grid){document.getElementById("grid_button").className="M_butt";ON_grid=0}else{ON_grid=1;document.getElementById("grid_button").className="M_butt_Selected_down"}}
function Angular_direct(){if(ON_angular_direct){ON_angular_direct=0;document.getElementById("angular_direct_button").className="M_butt_Selected_down"}else{ON_angular_direct=1;document.getElementById("angular_direct_button").className="M_butt"}Re_load()}
function Start_relation(){if(!ON_display_field)if(ON_relation){document.getElementById("pmd_hint").innerHTML="";document.getElementById("pmd_hint").style.display="none";document.getElementById("rel_button").className="M_butt";ON_relation=click_field=0}else{document.getElementById("foreign_relation").style.display="";ON_relation=1;document.getElementById("pmd_hint").innerHTML=PMA_messages.strSelectReferencedKey;document.getElementById("pmd_hint").style.display="block";document.getElementById("rel_button").className=
"M_butt_Selected_down"}}
function Click_field(a,b,c){if(ON_relation)if(click_field){Start_relation();if(j_tabs[db+"."+a]!="1"||!c)document.getElementById("foreign_relation").style.display="none";c=Glob_X-(document.getElementById("layer_new_relation").offsetWidth>>1);document.getElementById("layer_new_relation").style.left=c+"px";c=Glob_Y-document.getElementById("layer_new_relation").offsetHeight+40;document.getElementById("layer_new_relation").style.top=c+"px";document.getElementById("layer_new_relation").style.display="block";
link_relation+="&T2="+a+"&F2="+b}else{if(!c){alert(PMA_messages.strPleaseSelectPrimaryOrUniqueKey);return}if(j_tabs[db+"."+a]!="1")document.getElementById("foreign_relation").style.display="none";click_field=1;link_relation="T1="+a+"&F1="+b;document.getElementById("pmd_hint").innerHTML=PMA_messages.strSelectForeignKey}if(ON_display_field){if(display_field[a]==b){old_class="tab_field";delete display_field[a]}else{old_class="tab_field_3";if(display_field[a]){document.getElementById("id_tr_"+a+"."+display_field[a]).className=
"tab_field";delete display_field[a]}display_field[a]=b}ON_display_field=0;document.getElementById("pmd_hint").innerHTML="";document.getElementById("pmd_hint").style.display="none";document.getElementById("display_field_button").className="M_butt";makeRequest("pmd_display_field.php","T="+a+"&F="+b+"&server="+server+"&db="+db+"&token="+token)}}
function New_relation(){document.getElementById("layer_new_relation").style.display="none";link_relation+="&server="+server+"&db="+db+"&token="+token+"&die_save_pos=0";link_relation+="&on_delete="+document.getElementById("on_delete").value+"&on_update="+document.getElementById("on_update").value;link_relation+=Get_url_pos();makeRequest("pmd_relation_new.php",link_relation)}function Start_table_new(){window.location.href="tbl_create.php?server="+server+"&db="+db+"&token="+token}
function Start_tab_upd(a){window.location.href="tbl_structure.php?server="+server+"&db="+db+"&token="+token+"&table="+a}function Small_tab_all(a){if(a.alt=="v"){for(key in j_tabs)document.getElementById("id_hide_tbody_"+key).innerHTML=="v"&&Small_tab(key,0);a.alt=">";a.src=pmaThemeImage+"pmd/rightarrow1.png"}else{for(key in j_tabs)document.getElementById("id_hide_tbody_"+key).innerHTML!="v"&&Small_tab(key,0);a.alt="v";a.src=pmaThemeImage+"pmd/downarrow1.png"}Re_load()}
function Small_tab_invert(){for(key in j_tabs)Small_tab(key,0);Re_load()}function Relation_lines_invert(){show_relation_lines=!show_relation_lines;Re_load()}function Small_tab_refresh(){for(key in j_tabs)if(document.getElementById("id_hide_tbody_"+key).innerHTML!="v"){Small_tab(key,0);Small_tab(key,0)}}
function Small_tab(a,b){var c=document.getElementById("id_tbody_"+a),d=document.getElementById("id_hide_tbody_"+a),g=document.getElementById(a);g.style.width=g.offsetWidth+"px";if(d.innerHTML=="v"){c.style.display="none";d.innerHTML=">"}else{c.style.display="";d.innerHTML="v"}b&&Re_load()}
function Select_tab(a){if(document.getElementById("id_zag_"+a).className!="tab_zag_3")document.getElementById("id_zag_"+a).className="tab_zag_2";else document.getElementById("id_zag_"+a).className="tab_zag";var b=document.getElementById(a);window.scrollTo(parseInt(b.style.left)-300,parseInt(b.style.top)-300);setTimeout(function(){document.getElementById("id_zag_"+a).className="tab_zag"},800)}
function Canvas_click(){var a=0,b=0,c=[],d,g,f,h,n,j,l;Clear();for(K in contr)for(key in contr[K])for(key2 in contr[K][key])for(key3 in contr[K][key][key2])if(document.getElementById("check_vis_"+key2).checked&&document.getElementById("check_vis_"+contr[K][key][key2][key3][0]).checked){var m=document.getElementById(key2).offsetLeft+1,p=m+document.getElementById(key2).offsetWidth,o=document.getElementById(contr[K][key][key2][key3][0]).offsetLeft,q=o+document.getElementById(contr[K][key][key2][key3][0]).offsetWidth;
c[0]=Math.abs(m-o);c[1]=Math.abs(m-q);c[2]=Math.abs(p-o);c[3]=Math.abs(p-q);a=s_left=s_right=0;for(var r=1;r<4;r++)if(c[a]>c[r])a=r;if(a==1){j=m-sm_s;l=q+sm_s;if(j<l)a=0}if(a==2){j=p+sm_s;l=o-sm_s;if(j>l)a=0}if(a==3){j=p+sm_s;l=q+sm_s;s_right=1}if(a==0){j=m-sm_s;l=o-sm_s;s_left=1}a=document.getElementById(key2).offsetTop+document.getElementById(key2+"."+key3).offsetTop+height_field;m=document.getElementById(contr[K][key][key2][key3][0]).offsetTop+document.getElementById(contr[K][key][key2][key3][0]+
"."+contr[K][key][key2][key3][1]).offsetTop+height_field;if(!b&&Glob_X>j-10&&Glob_X<j+10&&Glob_Y>a-7&&Glob_Y<a+7){Line0(j-sm_x,a-sm_y,l-sm_x,m-sm_y,"rgba(255,0,0,1)");b=1;d=contr[K][key][key2][key3][0];g=contr[K][key][key2][key3][1];f=key2;h=key3;n=K}else Line0(j-sm_x,a-sm_y,l-sm_x,m-sm_y,getColorByTarget(contr[K][key][key2][key3][0]+"."+contr[K][key][key2][key3][1]))}if(b){b=Glob_X-(document.getElementById("layer_upd_relation").offsetWidth>>1);document.getElementById("layer_upd_relation").style.left=
b+"px";b=Glob_Y-document.getElementById("layer_upd_relation").offsetHeight-10;document.getElementById("layer_upd_relation").style.top=b+"px";document.getElementById("layer_upd_relation").style.display="block";link_relation="T1="+d+"&F1="+g+"&T2="+f+"&F2="+h+"&K="+n}}
function Upd_relation(){document.getElementById("layer_upd_relation").style.display="none";link_relation+="&server="+server+"&db="+db+"&token="+token+"&die_save_pos=0";link_relation+=Get_url_pos();makeRequest("pmd_relation_upd.php",link_relation)}function VisibleTab(a,b){if(a.checked)document.getElementById(b).style.display="block";else document.getElementById(b).style.display="none";Re_load()}
function Hide_tab_all(a){if(a.alt=="v"){a.alt=">";a.src=pmaThemeImage+"pmd/rightarrow1.png"}else{a.alt="v";a.src=pmaThemeImage+"pmd/downarrow1.png"}var b=document.form1;for(i=0;i<b.elements.length;i++)if(b.elements[i].type=="checkbox"&&b.elements[i].id.substring(0,10)=="check_vis_")if(a.alt=="v"){b.elements[i].checked=true;document.getElementById(b.elements[i].value).style.display="block"}else{b.elements[i].checked=false;document.getElementById(b.elements[i].value).style.display="none"}Re_load()}
function in_array_k(a,b){var c=0;for(u in b)if(a==u){c=1;break}return c}
function No_have_constr(a){var b=[];for(K in contr)for(key in contr[K])for(key2 in contr[K][key])for(key3 in contr[K][key][key2])b[key2]=b[contr[K][key][key2][key3][0]]=1;if(a.alt=="v"){a.alt=">";a.src=pmaThemeImage+"pmd/rightarrow2.png"}else{a.alt="v";a.src=pmaThemeImage+"pmd/downarrow2.png"}var c=document.form1;for(i=0;i<c.elements.length;i++)if(c.elements[i].type=="checkbox"&&c.elements[i].id.substring(0,10)=="check_vis_")if(!in_array_k(c.elements[i].value,b))if(a.alt=="v"){c.elements[i].checked=
true;document.getElementById(c.elements[i].value).style.display="block"}else{c.elements[i].checked=false;document.getElementById(c.elements[i].value).style.display="none"}}function PDF_save(){Save("pmd_pdf.php?server="+server+"&token="+token+"&db="+db)}function General_scroll(){clearTimeout(timeoutID);timeoutID=setTimeout(function(){document.getElementById("top_menu").style.left=document.body.scrollLeft+"px";document.getElementById("top_menu").style.top=document.body.scrollTop+"px"},200)}
function Show_left_menu(a){if(a.alt=="v"){var b=$("#top_menu").offset(),c=$("#top_menu").height();document.getElementById("layer_menu").style.top=b.top+c+"px";document.getElementById("layer_menu").style.left=b.left+"px";document.getElementById("layer_menu").style.display="block";a.alt=">";a.src=pmaThemeImage+"pmd/uparrow2_m.png";isIE&&General_scroll()}else{document.getElementById("layer_menu").style.top="-1000px";document.getElementById("layer_menu").style.display="none";a.alt="v";a.src=pmaThemeImage+
"pmd/downarrow2_m.png"}}function Top_menu_right(a){if(a.alt==">"){var b=10;$("#top_menu").children().each(function(){b+=$(this).outerWidth(true)});var c=parseInt(document.getElementById("top_menu").offsetWidth-b,10);document.getElementById("top_menu").style.paddingLeft=c+"px";a.alt="<";a.src=pmaThemeImage+"pmd/2leftarrow_m.png"}else{document.getElementById("top_menu").style.paddingLeft=0;a.alt=">";a.src=pmaThemeImage+"pmd/2rightarrow_m.png"}}
function Start_display_field(){if(!ON_relation)if(ON_display_field){document.getElementById("pmd_hint").innerHTML="";document.getElementById("pmd_hint").style.display="none";document.getElementById("display_field_button").className="M_butt";ON_display_field=0}else{ON_display_field=1;document.getElementById("pmd_hint").innerHTML=PMA_messages.strChangeDisplay;document.getElementById("pmd_hint").style.display="block";document.getElementById("display_field_button").className="M_butt_Selected_down";if(isIE)document.getElementById("display_field_button").className=
"M_butt_Selected_down_IE"}}var TargetColors=[];function getColorByTarget(a){var b="";for(c in TargetColors)if(TargetColors[c][0]==a){b=TargetColors[c][1];break}if(b.length==0){var c=TargetColors.length+1;b=c%6;var d=(c-b)/6;d%=4;d++;var g=[[1,0,0],[0,1,0],[0,0,1],[1,1,0],[1,0,1],[0,1,1]],f=g[b][0];c=g[b][1];b=g[b][2];e=1-(d-1)/6;d=Math.round(f*200*e);f=Math.round(c*200*e);c=Math.round(b*200*e);b="rgba("+d+","+f+","+c+",1)";TargetColors.push([a,b])}return b}
function Click_option(a,b,c){var d=Glob_X-(document.getElementById(a).offsetWidth>>1);document.getElementById(a).style.left=d+"px";document.getElementById(a).style.top=screen.height/4+"px";document.getElementById(a).style.display="block";document.getElementById("option_col_name").innerHTML="<strong>"+PMA_messages.strAddOption+'"'+b+'"</strong>';col_name=b;tab_name=c}function Close_option(){document.getElementById("pmd_optionse").style.display="none"}
function Select_all(a,b){var c=document.form1;downer=b;var d;d=[];for(d=0;d<c.elements.length;d++)if(c.elements[d].type=="checkbox"&&c.elements[d].id.substring(0,9+a.length)=="select_"+a+"._")if(document.getElementById("select_all_"+a).checked==true){c.elements[d].checked=true;c.elements[d].disabled=true;a.substring(b.length+1)}else{c.elements[d].checked=false;c.elements[d].disabled=false}if(document.getElementById("select_all_"+a).checked==true){select_field.push("`"+a.substring(b.length+1)+"`.*");
d=a.split(".");from_array.push(d[1])}else{for(d=0;d<select_field.length;d++)select_field[d]=="`"+a.substring(b.length+1)+"`.*"&&select_field.splice(d,1);for(k=0;k<from_array.length;k++)if(from_array[k]==a){from_array.splice(k,1);break}}Re_load()}
function Table_onover(a,b,c){if(b){document.getElementById("id_zag_"+a).className="tab_zag";if(c)document.getElementById("id_zag_"+a+"_2").className="tab_zag"}else{document.getElementById("id_zag_"+a).className="tab_zag_2";if(c)document.getElementById("id_zag_"+a+"_2").className="tab_zag_2"}}
function store_column(a,b,c){if(document.getElementById("select_"+b+"."+a+"._"+c).checked==true){select_field.push("`"+a+"`.`"+c+"`");from_array.push(a)}else{for(b=0;b<select_field.length;b++)if(select_field[b]=="`"+a+"`.`"+c+"`"){select_field.splice(b,1);break}for(c=0;c<from_array.length;c++)if(from_array[c]==a){from_array.splice(c,1);break}}}
function add_object(){var a=document.getElementById("rel_opt"),b=0,c=history_array.length;if(a.value!="--"){if(document.getElementById("Query").value==""){document.getElementById("pmd_hint").innerHTML="value/subQuery is empty";document.getElementById("pmd_hint").style.display="block";return}var d=document.getElementById("Query"),g=new where(a.value,d.value);history_array.push(new history(col_name,g,tab_name,h_tabs[downer+"."+tab_name],"Where"));b+=1;a.value="--";d.value=""}if(document.getElementById("new_name").value!=
""){a=new rename(document.getElementById("new_name").value);history_array.push(new history(col_name,a,tab_name,h_tabs[downer+"."+tab_name],"Rename"));b+=1;document.getElementById("new_name").value=""}if(document.getElementById("operator").value!="---"){a=new aggregate(document.getElementById("operator").value);history_array.push(new history(col_name,a,tab_name,h_tabs[downer+"."+tab_name],"Aggregate"));b+=1;document.getElementById("operator").value="---"}if(document.getElementById("groupby").checked==
true){history_array.push(new history(col_name,"GroupBy",tab_name,h_tabs[downer+"."+tab_name],"GroupBy"));b+=1;document.getElementById("groupby").checked=false}if(document.getElementById("h_rel_opt").value!="--"){if(document.getElementById("having").value==""){document.getElementById("pmd_hint").innerHTML="value/subQuery is empty";document.getElementById("pmd_hint").style.display="block";return}d=document.getElementById("having");g=new having(document.getElementById("h_rel_opt").value,d.value,document.getElementById("h_operator").value);
history_array.push(new history(col_name,g,tab_name,h_tabs[downer+"."+tab_name],"Having"));b+=1;document.getElementById("h_rel_opt").value="--";document.getElementById("h_operator").value="---";d.value=""}if(document.getElementById("orderby").checked==true){history_array.push(new history(col_name,"OrderBy",tab_name,h_tabs[downer+"."+tab_name],"OrderBy"));b+=1;document.getElementById("orderby").checked=false}document.getElementById("pmd_hint").innerHTML=b+"object created";document.getElementById("pmd_hint").style.display=
"block";document.getElementById("ab").innerHTML=display(c,history_array.length);Close_option();panel(0)};
