var player_update_div = document.getElementById('player_update_div');




document.getElementById('firstname_player_insert').addEventListener("keyup", function(e){
    if(e.keyCode==13){
        e.preventDefault();
        document.getElementsByName("playerinsert").click;
    }
});

document.getElementById('lastname_player_insert').addEventListener("keyup", function(e){
    if(e.keyCode==13){
        e.preventDefault();
        document.getElementsByName("playerinsert").click;
    }
});

document.getElementById('age_player_insert').addEventListener("keyup", function(e){
    if(e.keyCode==13){
        e.preventDefault();
        document.getElementsByName("playerinsert").click;
    }
});

document.getElementById('goals_player_insert').addEventListener("keyup", function(e){
    if(e.keyCode==13){
        e.preventDefault();
        document.getElementsByName("playerinsert").click;
    }
});


document.getElementById('firstname_player_update').addEventListener("keyup", function(e){
    if(e.keyCode==13){
        e.preventDefault();
        document.getElementsByName("playerupdate").click;
    }
});

document.getElementById('lastname_player_update').addEventListener("keyup", function(e){
    if(e.keyCode==13){
        e.preventDefault();
        document.getElementsByName("playerupdate").click;
    }
});

document.getElementById('age_player_update').addEventListener("keyup", function(e){
    if(e.keyCode==13){
        e.preventDefault();
        document.getElementsByName("playerupdate").click;
    }
});

document.getElementById('goals_player_update').addEventListener("keyup", function(e){
    if(e.keyCode==13){
        e.preventDefault();
        document.getElementsByName("playerupdate").click;
    }
});

document.getElementById('player_insert').addEventListener('submit', addPlayer);
document.getElementById('player_update').addEventListener('submit', updatePlayer);



function addPlayer(e){
    e.preventDefault();
    var firstname = document.getElementById('firstname_player_insert').value;
    var lastname = document.getElementById('lastname_player_insert').value;
    var age = document.getElementById('age_player_insert').value;
    var goals = document.getElementById('goals_player_insert').value;
    
    var position_doc = document.getElementById('id_select_position');
    var index = position_doc.selectedIndex;
    var postition = position_doc[index].innerHTML;

    var club_doc = document.getElementById('id_select_clubs');
    var index = club_doc.selectedIndex;
    var club = club_doc[index].innerHTML;

    var nation_doc = document.getElementById('id_select_nations');
    var index = nation_doc.selectedIndex;
    var nation = nation_doc[index].innerHTML;

    var params = "firstname_insert="+firstname+"&lastname_insert="+lastname+"&age_insert="+age+"&goals_insert="+goals+"&position_insert="+postition+"&nation_insert="+nation+"&club_insert="+club;
    

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/ajax_player.php',true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('tabela_player').innerHTML = this.responseText;
    }

    xhr.send(params);
    
}

function del(id){
    var ajdi = id.parentNode.parentNode.lastChild.innerHTML;
    
    var params = "id_delete="+ajdi;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/ajax_player.php',true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('tabela_player').innerHTML = this.responseText;
    }

    xhr.send(params);
}

function update(id){
    window.scrollTo(0, 0);
    player_update_div.style.visibility = 'visible';

    var firstname = id.parentNode.parentNode.firstChild.innerHTML;
    var lastname = id.parentNode.parentNode.children[1].innerHTML;
    var age = id.parentNode.parentNode.children[2].innerHTML;
    var position = id.parentNode.parentNode.children[3].innerHTML;
    var goals = id.parentNode.parentNode.children[4].innerHTML;
    var nation = id.parentNode.parentNode.children[5].innerHTML;
    var club = id.parentNode.parentNode.children[6].innerHTML;
    var ajdi = id.parentNode.parentNode.lastChild.innerHTML;

    
    var select_position = document.getElementById('id_update_position');
    var index;
    
    for(var i = 0; i < select_position.length; i++){
        if(select_position[i].innerHTML == position){
            index = i;
            break;
        }
    }
    select_position[index].selected=true;


    var select_nation = document.getElementById('id_update_nations');
    var index;
    for(var i = 0; i < select_nation.length; i++){
        if(select_nation[i].innerHTML == nation ){
            index = i;
            break;
        }
    }
    select_nation[index].selected=true;

    var select_club = document.getElementById('id_update_clubs');
    var index;
    for(var i = 0; i < select_club.length; i++){
        if(select_club[i].innerHTML == club ){
            index = i;
            break;
        }
    }
    select_club[index].selected=true;
    document.getElementById('firstname_player_update').value = firstname;
    document.getElementById('lastname_player_update').value = lastname;
    document.getElementById('age_player_update').value = age;
    document.getElementById('goals_player_update').value = goals;

    document.getElementById('id_player_update').value = ajdi;

    var player_update_text_classList = document.getElementById('firstname_player_update').classList;
    player_update_text_classList.add('green-glow')
    setTimeout(function(){player_update_text_classList.remove('green-glow')}, 350);  

    setTimeout(function(){
        player_update_text_classList.add('green-glow')
        setTimeout(function(){player_update_text_classList.remove('green-glow')}, 350);  }, 600);
}

function updatePlayer(e){
    e.preventDefault();
    var id = document.getElementById('id_player_update').value;
    var firstname = document.getElementById('firstname_player_update').value;
    var lastname = document.getElementById('lastname_player_update').value;
    var age = document.getElementById('age_player_update').value;
    var goals = document.getElementById('goals_player_update').value;
    
    var position_doc = document.getElementById('id_update_position');
    var index = position_doc.selectedIndex;
    var position = position_doc[index].innerHTML;

    var club_doc = document.getElementById('id_update_clubs');
    var index = club_doc.selectedIndex;
    var club = club_doc[index].innerHTML;

    var nation_doc = document.getElementById('id_update_nations');
    var index = nation_doc.selectedIndex;
    var nation = nation_doc[index].innerHTML;
    

    var params = "id_update="+id+"&firstname_update="+firstname+"&lastname_update="+lastname+"&age_update="+age+"&goals_update="+goals+"&position_update="+position+"&nation_update="+nation+"&club_update="+club;
    
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/ajax_player.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('tabela_player').innerHTML = this.responseText;
    }

    xhr.send(params);
}