// import ImageInsert from '../ckeditor5/ckeditor5-image/src/imageinsert';

BalloonEditor
    .create( 
        document.querySelector( '#editor' ), {
        // plugins: [ ImageInsert ],
        // toolbar: [ 'insertImage' ],
        //plugins: [ 'MediaEmbed' ],
        mediaEmbed: {previewsInData: true},
        fontFamily: {
            options: [
                'default',
                'Ubuntu, Arial, sans-serif',
                'Ubuntu Mono, Courier New, Courier, monospace'
            ]
        },
    })
    .then( editor => {
        document.querySelector("form[name=post]")
                .addEventListener("submit", function(e){
            e.preventDefault();
            this.querySelector("#post_content").value = editor.getData();
            this.submit();
        })
    } )
    .catch( error => {
        console.error( error );
    } );