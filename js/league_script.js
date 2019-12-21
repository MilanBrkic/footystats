var league_update_div = document.getElementById('league_update_div');
var error_insert_span = document.getElementById('error_league_insert');
var error_update_span = document.getElementById('error_league_update');


var leagues;



document.getElementById('name_league_insert').addEventListener("keyup", function(e){
    if(e.keyCode==13){
        e.preventDefault();
        document.getElementsByName("nameinsert").click;
    }
});


document.getElementById('name_league_update').addEventListener("keyup", function(e){
    if(e.keyCode==13){
        e.preventDefault();
        document.getElementsByName("nameupdate").click;
    }
});

document.getElementById('league_insert').addEventListener('submit', addLeague);
document.getElementById('league_update').addEventListener('submit', updateLeague);

function addLeague(e){
    e.preventDefault();
    error_insert_span.style.visibility="hidden";
    error_update_span.style.visibility="hidden";

    var league_name = document.getElementById('name_league_insert').value.trim();
    var nation_name_doc = document.getElementById('id_select_nations');
    var index = nation_name_doc.selectedIndex;
    var nation_name = nation_name_doc[index].innerHTML;

    if(league_name==""){
        error_insert_span.style.visibility="visible";
        error_insert_span.innerHTML = "League name cannot be empty";
        return;
    }


    getLeaguesNations();
    for(var i = 0;i<leagues.length;i++){
        if(name==leagues[i][0] && nation_name==leagues[i][1]){
            error_insert_span.style.visibility="visible";
            error_insert_span.innerHTML = "League already exists";
            return;
        }
    }


    var params = "league_insert="+league_name+"&nation_insert="+nation_name;
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/ajax_league.php',true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('tabela_league').innerHTML = this.responseText;
    }

    xhr.send(params);

    document.getElementById('name_league_insert').value = '';
    document.getElementById('name_league_update').value = "";
    document.getElementById('id_league_update').value = "";
    league_update_div.style.visibility="hidden";
}

function del(id){
    var ajdi = id.parentNode.parentNode.lastChild.innerHTML;
    error_insert_span.style.visibility="hidden";
    error_update_span.style.visibility="hidden";
    var params = "id_delete="+ajdi;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/ajax_league.php',true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('tabela_league').innerHTML = this.responseText;
    }

    xhr.send(params);

    document.getElementById('name_league_update').value = "";
    document.getElementById('id_league_update').value = "";
    league_update_div.style.visibility="hidden";
}

function update(id){
    error_insert_span.style.visibility="hidden";
    error_update_span.style.visibility="hidden";
    window.scrollTo(0, 0);
    league_update_div.style.visibility = 'visible';
    
    var name_nation = id.parentNode.parentNode.children[1].innerHTML;
    
    var name_league = id.parentNode.parentNode.firstChild.innerHTML
    var ajdi = id.parentNode.parentNode.lastChild.innerHTML
    var select_nations = document.getElementById('id_update_nations');
    var index;
    for(var i = 0; i < select_nations.length; i++){
        if(select_nations[i].innerHTML == name_nation){
            index = i;
            break;
        }
    }
    select_nations[index].selected=true;
    
    var name_league_update_text = document.getElementById('name_league_update')
    name_league_update_text.value = name_league;
    document.getElementById('id_league_update').value = ajdi;

    var league_update_text_classList = name_league_update_text.classList;
    
    league_update_text_classList.add('green-glow')
    setTimeout(function(){league_update_text_classList.remove('green-glow')}, 350);  

    setTimeout(function(){
        league_update_text_classList.add('green-glow')
        setTimeout(function(){league_update_text_classList.remove('green-glow')}, 350);  }, 600);
    
}

function updateLeague(e){
    e.preventDefault();
    error_insert_span.style.visibility="hidden";
    error_update_span.style.visibility="hidden";
    var name = document.getElementById('name_league_update').value;
    var id = document.getElementById('id_league_update').value;

    var nation_name_doc = document.getElementById('id_update_nations');
    var index = nation_name_doc.selectedIndex;
    var nation_name = nation_name_doc[index].innerHTML;
    
    if(name==""){
        error_update_span.style.visibility="visible";
        error_update_span.innerHTML = "League name cannot be empty";
        return;
    }


    getLeaguesNations();
    for(var i = 0;i<leagues.length;i++){
        if(name==leagues[i][0] && nation_name==leagues[i][1]){
            error_update_span.style.visibility="visible";
            error_update_span.innerHTML = "League already exists";
            return;
        }
    }
    
    var params = "id_update="+id+"&name_update="+name+"&nation_name_update="+nation_name;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/ajax_league.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('tabela_league').innerHTML = this.responseText;
    }

    xhr.send(params);
}


function getLeaguesNations(){
    var table_league = document.getElementById('tabela_league');
    var kolekcija_redova_pre = table_league.children[0].children[0].children;
    var kolekcija_redova = table_league.children[0].children[0].children[0].children;
    
    leagues= new Array(kolekcija_redova_pre.length-1)
    // console.log(leagues);
    for(var i= 0;i<leagues.length;i++){
        leagues[i] = new Array(2);
    }
    // console.log(leagues);

    // console.log(kolekcija_redova_pre);
    // console.log(kolekcija_redova);
    
    
    for(var i = 1;i<kolekcija_redova_pre.length;i++){
        
        leagues[i-1][0] = kolekcija_redova_pre[i].children[0].innerHTML;
        leagues[i-1][1] = kolekcija_redova_pre[i].children[1].innerHTML;
    }
   
    // for(i=0;i<leagues.length;i++){
    //     console.log(leagues[i][0], leagues[i][1]);
    // }
}


