

let slash="\\\\\\\\";

let html_massiv =[];
html_massiv[0]={name:"Параграф", value:"<p></p>"};
html_massiv[1]={name:"Таблица",value:"<table>"+"\\r\\n\\t"+"<tr><th>..</th> <th>..</th></tr>"+"\\r\\n\\t"+"<tr><td>..</td> <td>..</td></tr>"+"\\r\\n"+"</table>"};
html_massiv[2]={name:"Список нумерованный",value:"<ol>"+"\\r\\n\\t"+"<li>..</li> "+"\\r\\n\\t"+"<li>..</li> "+"\\r\\n\\t"+"<li>..</li>"+"\\r\\n"+"</ol>"};
html_massiv[3]={name:"Список маркированный",value:"<ul>"+"\\r\\n\\t"+"<li>..</li> "+"\\r\\n\\t"+"<li>..</li> "+"\\r\\n\\t"+"<li>..</li>"+"\\r\\n"+"</ul>"};

let math_massiv =[];
math_massiv[0]={name:"Формула", value:"<div class="+"\\\""+"formula"+"\\\""+"></div>"};
math_massiv[1]={name:"Формула стр ", value:"<span class="+"\\\""+"formula"+"\\\""+"></span>"};
math_massiv[2]={name:"\\sqrt{x}", value:slash+"sqrt{} "};
math_massiv[3]={name:"\\cfrac{a}{b}", value:slash+"cfrac{}{}"};

let chem_massiv =[];
chem_massiv[0]={name:"F", value:"<div class="+"\\\""+"chem"+"\\\""+"></div>"};
chem_massiv[1]={name:" H-C-H; H|#C|H", value:" H-C-H; H|#C|H"};
chem_massiv[2]={name:" H-C; #2//O; #2\\OH", value:" H-C; #2//O; #2\\\\\\\\OH"};

let prog_massiv=[]
{
    prog_massiv[0]={name:"javascript", value:"<pre><code class="+"\\\""+"language-javascript"+"\\\""+">"+"\\r\\n"+"\\r\\n"+" </code></pre>"};
}
function ins( name) {
    let redactor = document.getElementById("text") ;
    let position = redactor.selectionStart;
    let text = redactor.value;
    let first = text.slice(0,position);
    let second = text.slice(position);

    redactor.value=first+name+second;
}

function menu(massiv,name, type="" ) {


let text_inner='';
    text_inner+="<details>";
    text_inner+="<summary>"+name+"</summary>";
    for (let i=0; i<massiv.length;i++)
    {
        let name= massiv[i].name;
        let value= massiv[i].value;
        text_inner+="<label><p "+type+"  onclick='ins(\" "+value+" \" )' >"+name+"</p></label>";

    }

    text_inner+="</details>";

    return text_inner;

}

let menu_el = document.getElementById("menu");
menu_el.innerHTML=menu(html_massiv,"HTML");
menu_el.innerHTML+=menu(math_massiv,"MATH","class ='formula'");
menu_el.innerHTML+=menu(chem_massiv,"CHEM","class ='chem'");
menu_el.innerHTML+=menu(prog_massiv,"CODE");

function upload_img() {
    alert("Фото загружено");

}
















// находим элемент, в который будем рендерить формулу
var el = document.getElementsByClassName("formula");

// вызываем метод библиотеки для отображения формулы

for (let i=0;i<el.length;i++)
    katex.render(el[i].innerHTML, el[i])

var el = document.getElementsByClassName("chem");

for (let i=0;i<el.length;i++)
{
    var elem2 = el[i];
    var ex2 = ChemSys.compile( el[i].innerHTML);
    el[i].innerHTML="";
    ChemSys.draw(elem2, ex2);
}
