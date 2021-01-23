// Add link in the top page 
$(document).ready(function(){
    $('tr[data-href]').addClass('clickable').click(function(){
        window.location = $(this).attr('data-href');
    });
});

// Add line in the edit page
$('.addBtn').click( function() {
    $('.chord-lyric').each(function(){
        console.log(this);
        if($(this).hasClass('hide')) {
            $(this).removeClass('hide');
            return false;
        }
    })
});

// Scroll down automatically
let scrollStatus = false;
let speed = 50;
$('.chord-area').click( function(){
    if (scrollStatus){
        scrollStatus = false;
    } else {
        scrollStatus = true;
        scrollPage();
    }
});

function scrollPage() {
    if (scrollStatus){
        window.scrollBy(0,1);
        setTimeout('scrollPage()', speed);
    }
}

// Change the Keys in the song page
$('.key-up').click( function() {
    $('.chord').each(function(index, obj){
        let chordText = $(obj).text();
        chordText = keyUp(chordText);
        $(this).text(chordText);
    });
    let capo = $('#capoCount').text();
    capo = (Number(capo) - 1);
    if (capo < 0) { capo += 12; }
    $('#capoCount').text(capo);
});

function keyUp(text) {
    chordArray = text.split(/([　]+)/);
    
    chordArray.forEach(function(str, index){
        if (str.includes('/')) {
            onChordArray = str.split(/([/]+)/);
            onChordArray[0] = oneUp(onChordArray[0]);
            onChordArray[2] = oneUp(onChordArray[2]);
            chordArray[index] = onChordArray.join('');
        } else {
            chordArray[index] = oneUp(str);
        }
    });
    return chordArray.join('');
}

function oneUp(str) {
    if(str.startsWith('A#')){
        str = str.replace('A#','B');
    } else if(str.startsWith('C#')){
        str = str.replace('C#','D');
    } else if(str.startsWith('D#')){
        str = str.replace('D#','E');
    } else if(str.startsWith('F#')){
        str = str.replace('F#','G');
    } else if(str.startsWith('G#')){
        str = str.replace('G#','A');
    } else if(str.startsWith('A')){
        str = str.replace('A','A#');
    } else if(str.startsWith('B')){
        str = str.replace('B','C');
    } else if(str.startsWith('C')){
        str = str.replace('C','C#');
    } else if(str.startsWith('D')){
        str = str.replace('D','D#');
    } else if(str.startsWith('E')){
        str = str.replace('E','F');
    } else if(str.startsWith('F')){
        str = str.replace('F','F#');
    } else if(str.startsWith('G')){
        str = str.replace('G','G#');
    }
    return str;
}

$('.key-down').click( function() {
    $('.chord').each(function(index, obj){
        let chordText = $(obj).text();
        chordText = keyDown(chordText);
        $(this).text(chordText);
    });
    let capo = $('#capoCount').text();
    capo = (Number(capo) + 1) % 12;
    $('#capoCount').text(capo);
});

function keyDown(text) {
    chordArray = text.split(/([　]+)/);
    chordArray.forEach(function(str, index){
        if (str.includes('/')) {
            onChordArray = str.split(/([/]+)/);
            onChordArray[0] = oneDown(onChordArray[0]);
            onChordArray[2] = oneDown(onChordArray[2]);
            chordArray[index] = onChordArray.join('');
        } else {
            chordArray[index] = oneDown(str);
        }
    });
    return chordArray.join('');
}

function oneDown(str) {
    if(str.startsWith('A#')){
        str = str.replace('A#','A');
    } else if(str.startsWith('C#')){
        str = str.replace('C#','C');
    } else if(str.startsWith('D#')){
        str = str.replace('D#','D');
    } else if(str.startsWith('F#')){
        str = str.replace('F#','F');
    } else if(str.startsWith('G#')){
        str = str.replace('G#','G');
    } else if(str.startsWith('A')){
        str = str.replace('A','G#');
    } else if(str.startsWith('B')){
        str = str.replace('B','A#');
    } else if(str.startsWith('C')){
        str = str.replace('C','B');
    } else if(str.startsWith('D')){
        str = str.replace('D','C#');
    } else if(str.startsWith('E')){
        str = str.replace('E','D#');
    } else if(str.startsWith('F')){
        str = str.replace('F','E');
    } else if(str.startsWith('G')){
        str = str.replace('G','F#');
    }
    return str;
}

$('.key-original').click( function() {
    let capo = $('#capoCount').text();
    for (let i = 0; i < (Number(capo)); i++) {
        $('.chord').each(function(index, obj){
            let chordText = $(obj).text();
            chordText = keyUp(chordText);
            $(this).text(chordText);
        });
    }
    $('#capoCount').text(0);
});

// keyController in the song page
$('.toggle-controller').click( function() {
    let toggleStatus = $(this).text();
    if (toggleStatus == 'ー') {
        $('.controller-btn').hide();
        $('.key-controller').css('height', '10vh');
        $(this).text('＋');
    } else if (toggleStatus == '＋') {
        $('.controller-btn').show();
        $('.key-controller').css('height', '66vh');
        $(this).text('ー');
    }
});

$('.speed-up').click( function() {
    if (speed > 0) {
        speed -= 10;
        currentSpeed = $('#speedCount').text();
        newSpeed = Number(currentSpeed) + 1;
        $('#speedCount').text(newSpeed);
    }
});

$('.speed-down').click( function() {
    if (speed < 100) {
        speed += 10;
        currentSpeed = $('#speedCount').text();
        newSpeed = Number(currentSpeed) - 1;
        $('#speedCount').text(newSpeed);
    }
});
