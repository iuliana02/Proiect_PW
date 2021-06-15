
  $(document).ready(function(){
  $('#menuBackground').css({'width','500px'});
  $('#menuBackground').css({'margin': 'auto', 'padding': '0', 'font-family': 'Arial, Helvetica, sans-serif', 'font-size': '18px', 'font-weight': 'bold', 'line-height': '150%', 'background-color': ' #d4d4f7'});
  $("#menuBackground").css({'text-align':'center'});
  $('#dropDownMenu a').css({'color':'#a3297a', 'padding':'10px 20px', 'display':'block', 'text-decoration':'none'});
  $('#dropDownMenu, #dropDownMenu ul').css({'list-style':'none', 'margin':'0', 'padding':'0'});
  $('#dropDownMenu li').css({'position':'relative'});
  $('#dropDownMenu a:hover').css('background-color', '#d4d4f7');

  //Level 1
  $('#dropDownMenu>li').css({'display':'inline-block', 'vertical-align':'top', 'margin-left':'-4px'});
  $('#dropDownMenu>li:first-child').css({'margin-left':'0'});

  // //Level 2
  $('#dropDownMenu ul').css({'box-shadow': '2px 2px 15px 0 rgba(0,0,0, 0.5)'});
  //copii directi ai fiecarui elem din li (primul set de sub-teme)
  $('#dropDownMenu > li > ul').css({'text-align':'left', 'display': 'none', 'background-color':' #cce6ff', 'position': 'absolute', 'top':'100%', 'left':'0', 'width': '240px', 'z-index':'999999'});
  //
  // //Level 3
  $('#dropDownMenu > li > ul > li > ul').css({'text-align':'left', 'display': 'none', 'background':'#cce6ff', 'position':'absolute', 'left':'100%', 'top':'0', 'width': '140px', 'z-index':'999999'})


  $("#dropDownMenu a").hover(
    function(){
    $(this).css('background-color', '#E6E6FA');
  },
  function(){
  $(this).css('background-color', '#d4d4f7');
  }
);

$("#dropDownMenu li > ul a").hover(
  function(){
  $(this).css('background-color', '#d4d4f7');
},
function(){
$(this).css('background-color', '#cce6ff');
}
);

  //functia pt drop-down
  //clasa has-children am pus-o la toate li-urile care au alta lista ca si element
  $('.menu ul li.has-children > a').click(function() {
    $(this).parent().siblings().find('ul').stop(true, true).slideUp(300);
    $(this).parent().children('ul').stop(true, true).slideToggle(400);
  });
});
