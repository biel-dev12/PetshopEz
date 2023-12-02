function showImageEdit(input) {console.log("chamou");
    var imagemPreview = document.getElementById('EditimagePreview');
    var file = input.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {console.log("e.target.result:", e.target.result);
        imagemPreview.src = e.target.result;
        // imagemPreview.style.display = 'block'; 
    };

    reader.readAsDataURL(file);
}