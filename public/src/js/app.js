var postid = 0;
var postBodyElement = null;

$('.post').find('.interaction').find('a').eq(2).on('click', function(event) {
   event.preventDefault();
   postBodyElement = event.target.parentNode.parentNode.childNodes[1];
   var postBody = postBodyElement.textContent;
   postid = event.target.parentNode.parentNode.dataset['postid'];
   $('#post-body').val(postBody);
   $("#edit-modal").modal();
});

$(".modal-save").on('click', function(){
   $.ajax({
      method: 'POST',
      url: url,
      data: { body: $('#post-body').val(), postId: postid, _token: token}
   })
    .done(function(msg){
         $(postBodyElement).text();
    });
});