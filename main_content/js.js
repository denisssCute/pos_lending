//главные действующие лица, всевозможные инпуты,текстовые поля для переброски данных в другие формы
let title_disciplina = document.querySelector('#title_disciplina');
let group_number = document.querySelector('#group_number');
let disciplina = document.querySelector("[name='disciplina_name']");
let name_for_js = document.querySelectorAll('.name_for_js');
let toSQLinput = document.querySelector('#toSQLinput');
let tableInv = document.querySelectorAll('.a');
let searchBtn = document.querySelector('.search_btn');
let updateBtn = document.querySelector('#updateBtn');
let selectUpdateGroup = document.querySelector('#selectUpdateGroup');
let nameList = {};

//счётчиковые переменные, мб какая-то из них нигда не используется, но лучше не удалять :)
let index = 0;
let id;
let formPersStat;
let list;
function showPersonStats(el) { //функция, вызывается при нажатии на студента и показывает справа таблицу со статистикой по всем предметам
        tableInv.forEach(item =>{item.classList.add('invisible');item.classList.remove('table-right')})
    
        id = el+'_persStat'
        formPersStat = document.getElementById(id)
        formPersStat.classList.remove('invisible')
        formPersStat.classList.add('table-right')
}

group_number.innerHTML = localStorage.getItem('group_number'); // косметическая функция
