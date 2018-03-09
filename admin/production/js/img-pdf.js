$('#preview-pdf').hover(
    function() {
        $(this).find('a').fadeIn();
    }, function() {
        $(this).find('a').fadeOut();
    }
)
$('#file-select-pdf').on('click', function(e) {
     e.preventDefault();
    
    $('#pdf').click();
})

$('#pdf').change(function() {
    var file = (this.files[0].name).toString();
    var reader = new FileReader();
    
    $('#file-info-pdf').text('');
    $('#file-info-pdf').text(file);
    
     reader.onload = function (e) {
         $('#preview-pdf img').attr('src', 'images/subiendo-pdf.jpeg');
	 }
     
     reader.readAsDataURL(this.files[0]);
});

