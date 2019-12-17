var club_update_div = document.getElementById('club_update_div');




document.getElementById('name_club_insert').addEventListener("keyup", function(e){
    if(e.keyCode==13){
        e.preventDefault();
        document.getElementsByName("nameinsert").click;
    }
});


document.getElementById('name_club_update').addEventListener("keyup", function(e){
    if(e.keyCode==13){
        e.preventDefault();
        document.getElementsByName("nameupdate").click;
    }
});

document.getElementById('club_insert').addEventListener('submit', addClub);
document.getElementById('club_update').addEventListener('submit', updateClub);

function addClub(e){
    e.preventDefault();

    var club_name = document.getElementById('name_club_insert').value;
    

    var league_name_doc = document.getElementById('id_select_leagues');
    var index = league_name_doc.selectedIndex;
    var league_name = league_name_doc[index].innerHTML;
    
    var club_stadium = document.getElementById('stadium_club_insert').value;

    var params = "club_insert="+club_name+"&stadium_insert="+club_stadium+"&league_insert="+league_name;
    

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/ajax_club.php',true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('tabela_club').innerHTML = this.responseText;
    }

    xhr.send(params);
}

function del(id){
    var ajdi = id.parentNode.parentNode.lastChild.innerHTML;
    
    var params = "id_delete="+ajdi;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/ajax_club.php',true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('tabela_club').innerHTML = this.responseText;
    }

    xhr.send(params);
}

function update(id){
    window.scrollTo(0, 0);
    club_update_div.style.visibility = 'visible';

    var name_league = id.parentNode.parentNode.children[2].innerHTML;
    
    var name_club = id.parentNode.parentNode.firstChild.innerHTML
    var name_stadium = id.parentNode.parentNode.children[1].innerHTML
    var ajdi = id.parentNode.parentNode.lastChild.innerHTML;
    var select_leagues = document.getElementById('id_update_leagues');
    var index;
    for(var i = 0; i < select_leagues.length; i++){
        if(select_leagues[i].innerHTML == name_league){
            index = i;
            break;
        }
    }
    select_leagues[index].selected=true;
    
    var name_club_update_text = document.getElementById('name_club_update')
    name_club_update_text.value = name_club;
    
    document.getElementById('id_club_update').value = ajdi;

    var stadium_club_update_text = document.getElementById('stadium_club_update')
    stadium_club_update_text.value = name_stadium;

    var club_update_text_classList = name_club_update_text.classList;
    
    club_update_text_classList.add('green-glow')
    setTimeout(function(){club_update_text_classList.remove('green-glow')}, 350);  

    setTimeout(function(){
        club_update_text_classList.add('green-glow')
        setTimeout(function(){club_update_text_classList.remove('green-glow')}, 350);  }, 600);
}

function updateClub(e){
    
    e.preventDefault();
    
    var name = document.getElementById('name_club_update').value;
    var id = document.getElementById('id_club_update').value;
    var stadium = document.getElementById('stadium_club_update').value;

    var league_name_doc = document.getElementById('id_update_leagues');
    var index = league_name_doc.selectedIndex;
    var league_name = league_name_doc[index].innerHTML;
    

    var params = "id_update="+id+"&name_update="+name+"&stadium_update="+stadium+"&league_update="+league_name;
    console.log(params);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/ajax_club.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('tabela_club').innerHTML = this.responseText;
    }

    xhr.send(params);
    
}