

let slash="\\\\\\\\";

let html_massiv =[];
html_massiv[0]={name:"Параграф", value:"<p></p>"};
html_massiv[1]={name:"Таблица",value:"<table>"+"\\r\\n\\t"+"<tr><th>..</th> <th>..</th></tr>"+"\\r\\n\\t"+"<tr><td>..</td> <td>..</td></tr>"+"\\r\\n"+"</table>"};
html_massiv[2]={name:"Список нумерованный",value:"<ol>"+"\\r\\n\\t"+"<li>..</li> "+"\\r\\n\\t"+"<li>..</li> "+"\\r\\n\\t"+"<li>..</li>"+"\\r\\n"+"</ol>"};
html_massiv[3]={name:"Список маркированный",value:"<ul>"+"\\r\\n\\t"+"<li>..</li> "+"\\r\\n\\t"+"<li>..</li> "+"\\r\\n\\t"+"<li>..</li>"+"\\r\\n"+"</ul>"};
html_massiv.push({name:"Заголовок 1", value:"<h1></h1>"});
html_massiv.push({name:"Заголовок 2", value:"<h2></h2>"});
html_massiv.push({name:"Заголовок 3", value:"<h3></h3>"});
html_massiv.push({name:"Степень", value:"<sup></sup>"});
html_massiv.push({name:"Индекс", value:"<sub></sub>"});

let math_massiv =[];
math_massiv[0]={name:"Формула", value:"<div class="+"\\\""+"formula"+"\\\""+"></div>"};
math_massiv[1]={name:"Формула стр ", value:"<span class="+"\\\""+"formula"+"\\\""+"></span>"};
math_massiv[2]={name:"\\sqrt{x}", value:slash+"sqrt{} "};
math_massiv[3]={name:"\\cfrac{a}{b}", value:slash+"cfrac{}{}"};

let chem_massiv =[];
chem_massiv[0]={name:"F", value:"<div class="+"\\\""+"chem"+"\\\""+"></div>"};
chem_massiv[1]={name:"S", value:"<div class="+"\\\""+"chem_str"+"\\\""+"></div>"};
chem_massiv[2]={name:" H-C-H; H|#C|H", value:" H-C-H; H|#C|H"};
chem_massiv[3]={name:" H-C; #2//O; #2\\OH", value:" H-C; #2//O; #2\\\\\\\\OH"};

let math_trig =[];
math_trig.push({name:"\\sin{x}", value:slash+"sin "});
math_trig.push({name:"\\cos{x}", value:slash+"cos "});
math_trig.push({name:"\\tan{x}", value:slash+"tan "});
math_trig.push({name:"\\ctg{x}", value:slash+"ctg "});
math_trig.push({name:"\\cfrac{\\sin{x}}{\\cos{x}}", value:slash+"cfrac{"+slash+"sin x}{"+slash+"cos x }"});
math_trig.push({name:"\\cfrac{\\pi}{2}", value:slash+"cfrac{"+slash+"pi}{2} "});
math_trig.push({name:"\\cfrac{\\pi}{3}", value:slash+"cfrac{"+slash+"pi}{3} "});
math_trig.push({name:"\\cfrac{\\pi}{4}", value:slash+"cfrac{"+slash+"pi}{4} "});
math_trig.push({name:"\\cfrac{\\sqrt{2}}{2}", value:slash+"cfrac{"+slash+"sqrt{2}}{2} "});
math_trig.push({name:"\\cfrac{\\sqrt{3}}{2}", value:slash+"cfrac{"+slash+"sqrt{3}}{2} "});
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

function menu(massiv,name, table, type="" ) {


let text_inner='';
    text_inner+="<details>";
    text_inner+="<summary>"+name+"</summary>";
    text_inner+="<table border='1'>";
    for (let i=0; i<massiv.length;i++)
    {
        if(i%table == 0)
            text_inner+="<tr>";
        let name= massiv[i].name;
        let value= massiv[i].value;
        text_inner+="<td><label><p "+type+"  onclick='ins(\" "+value+" \" )' >"+name+"</p></label></td>";
        if(i%table == (table-1))
            text_inner+="</tr>";
    }
    text_inner+="</table>";
    text_inner+="</details>";

    return text_inner;

}

let menu_el = document.getElementById("menu",1);
menu_el.innerHTML=menu(html_massiv,"HTML",2);
menu_el.innerHTML+=menu(math_massiv,"MATH",1,"class ='formula'");
menu_el.innerHTML+=menu(math_trig,"TRIG",4,"class ='formula'");
menu_el.innerHTML+=menu(chem_massiv,"CHEM",1,"class ='chem'");
menu_el.innerHTML+=menu(prog_massiv,"CODE",1);

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

var el = document.getElementsByClassName("chem_str");

for (let i=0;i<el.length;i++)
{
    var elem2 = el[i];
    var ex2 = ChemSys.compile( el[i].innerHTML);
    el[i].innerHTML=ex2.html();

}
