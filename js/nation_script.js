var nation_update_div = document.getElementById('nation_update_div');
var error_insert_span = document.getElementById('error_nation_insert');
var error_update_span = document.getElementById('error_nation_update');

var nations;
var par = 0;
// console.log(table_nation.children[0].children[0].children[0].children[0].innerHTML);

// getNations();


document.getElementById('name_nation_insert').addEventListener("keyup", function(e){
    if(e.keyCode==13){
        e.preventDefault();
        document.getElementsByName("nameinsert").click;
    }
});


document.getElementById('name_nation_update').addEventListener("keyup", function(e){
    if(e.keyCode==13){
        e.preventDefault();
        document.getElementsByName("nameupdate").click;
    }
});

document.getElementById('nation_insert').addEventListener('submit', addNation);
document.getElementById('nation_update').addEventListener('submit', updateNation);




function update(id){
    error_insert_span.style.visibility="hidden";
    error_update_span.style.visibility="hidden";

    window.scrollTo(0, 0);
    nation_update_div.style.visibility = 'visible';
    
    var name = id.parentNode.parentNode.firstChild.innerHTML
    var ajdi = id.parentNode.parentNode.lastChild.innerHTML
    

    var name_nation_update_text = document.getElementById('name_nation_update')
    name_nation_update_text.value = name;
    document.getElementById('id_nation_update').value = ajdi;

    var nation_update_text_classList = name_nation_update_text.classList;
    
    nation_update_text_classList.add('green-glow')
    setTimeout(function(){nation_update_text_classList.remove('green-glow')}, 350);  

    setTimeout(function(){
        nation_update_text_classList.add('green-glow')
        setTimeout(function(){nation_update_text_classList.remove('green-glow')}, 350);  }, 600);
}

function updateNation(e){
    e.preventDefault();
    error_insert_span.style.visibility="hidden";
    error_update_span.style.visibility="hidden";
    
    
    var table_nation = document.getElementById('tabela_nation');
    var sort = table_nation.children[0].children[0].children[0].children[0].innerHTML;
    var name = document.getElementById('name_nation_update').value;

    if(name==""){
        error_update_span.style.visibility="visible";
        error_update_span.innerHTML = "Nation name cannot be empty";
        return;
    }
    getNations();
    
    for(var i = 0;i<nations.length;i++){
        if(name==nations[i]){
            error_update_span.style.visibility="visible";
            error_update_span.innerHTML = "Nation already exists";
            return;
        }
    }
    
    var id = document.getElementById('id_nation_update').value;
    var params = "name_update="+name+"&id_update="+id+"&sort="+sort;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/ajax_nation.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        table_nation.innerHTML = this.responseText;
    }

    xhr.send(params);
}

function del(id){
    error_insert_span.style.visibility="hidden";
    error_update_span.style.visibility="hidden";
    var table_nation = document.getElementById('tabela_nation');
    var sort = table_nation.children[0].children[0].children[0].children[0].innerHTML;
    var ajdi = id.parentNode.parentNode.lastChild.innerHTML
    
    var params = "id_delete="+ajdi+"&sort="+sort;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/ajax_nation.php',true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        table_nation.innerHTML = this.responseText;
    }

    xhr.send(params);

    document.getElementById('name_nation_update').value = "";
    document.getElementById('id_nation_update').value = "";
    nation_update_div.style.visibility="hidden";
    
}

function addNation(e){
    
    e.preventDefault();
    nation_update_div.style.visibility="hidden";
    var table_nation = document.getElementById('tabela_nation');
    error_insert_span.style.visibility="hidden";
    var sort = table_nation.children[0].children[0].children[0].children[0].innerHTML;
    

    var name = document.getElementById('name_nation_insert').value.trim();
    if(name==""){
        
        error_insert_span.style.visibility="visible";
        error_insert_span.innerHTML = "Nation name cannot be empty";
        return;
    }
    
    getNations();
    for(var i = 0;i<nations.length;i++){
        if(name==nations[i]){
            error_insert_span.style.visibility="visible";
            error_insert_span.innerHTML = "Nation already exists";
            return;
        }
    }
    
    var params = "name_insert="+name+"&sort="+sort;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/ajax_nation.php',true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        table_nation.innerHTML = this.responseText;
    }

    xhr.send(params);

    

    document.getElementById('name_nation_insert').value = '';
    document.getElementById('name_nation_update').value = "";
    document.getElementById('id_nation_update').value = "";
    
}

function getNations(){
    var table_nation = document.getElementById('tabela_nation');
    // var kolekcija_redova_pre = table_nation.children[0].children[0].children;
    var kolekcija_redova = table_nation.children[0].children[0].children;
    
    
    nations = Array(kolekcija_redova.length-1);
    // console.log(table_nation.children)
    // console.log(table_nation.children[0].children);
    // console.log(kolekcija_redova_pre);
    // console.log(kolekcija_redova);
    
    
    for(var i = 1;i<kolekcija_redova.length;i++){
        
        nations[i-1] = kolekcija_redova[i].children[0].innerHTML;
    }
   
    // for(i=0;i<nations.length;i++){
    //     console.log(nations[i]);
    // }
}

function sort(){
    var table_nation = document.getElementById('tabela_nation');
    var nation_sort = table_nation.children[0].children[0].children[0].children[0].innerHTML;
    if(par%2==0){
        nation_sort = 'Nation ▲'
    }
    else nation_sort = 'Nation ▼'
    par++;
    var sort = nation_sort;
    
    var params = "sort="+sort;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/ajax_nation.php',true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        table_nation.innerHTML = this.responseText;
    }

    xhr.send(params);
}


getNations();