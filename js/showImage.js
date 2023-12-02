function showImage(input) {
    var imagemPreview = document.getElementById('imagemPreview');
    var file = input.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        imagemPreview.src = e.target.result;
        imagemPreview.style.display = 'block'; // Exibir a imagem
    };

    reader.readAsDataURL(file);
}  
