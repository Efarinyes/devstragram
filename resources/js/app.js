import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Puja la teva imatge',
    acceptedFiles: '.png, .jpg, .jpeg, .gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borra la imatge',
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if(document.querySelector('[name="imatge"]').value.trim()) {
            const imtagePublicada = {};
            imtagePublicada.size = 1234;
            imtagePublicada.name = document.querySelector('[name="imatge"]').value;

            this.options.addedfile.call( this, imtagePublicada);
            this.options.thumbnail.call(this, imtagePublicada, `/uploads/${imtagePublicada.name}`);

            imtagePublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
})

dropzone.on('success', function(file, response){
    console.log(response.imatge);
    document.querySelector('[name="imatge"]').value = response.imatge;
})

dropzone.on('removedfile', function() {
    document.querySelector('[name="imatge"]').value = '';
})
