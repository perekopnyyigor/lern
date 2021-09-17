
// находим элемент, в который будем рендерить формулу
var el = document.getElementsByClassName("formula");

// вызываем метод библиотеки для отображения формулы

for (let i=0;i<el.length;i++)
    katex.render(el[i].innerHTML, el[i]);

var el = document.getElementsByClassName("chem");

for (let i=0;i<el.length;i++)
{
    var elem2 = el[i];
    var ex2 = ChemSys.compile( el[i].innerHTML);
    el[i].innerHTML="";
    ChemSys.draw(elem2, ex2);
}

hljs.highlightAll();