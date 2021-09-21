require('./bootstrap');


// creiamo un pulsante quando cerchiamo di cancellare qualcosa. Per confermare se si voglia o meno cancellare un dato.



const deleteForm = document.querySelectorAll('.delete-post-form');



deleteForm.forEach(item => {

    item.addEventListener('submit', function(event){
       const resp = confirm('Sei sicuro di voler cancellare il dato?');

       if(!resp) {
           event.preventDefault();
       }
    })
});