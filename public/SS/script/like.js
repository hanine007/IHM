/* $('body').on('submit', '#form-js', function(e){
    console.log("hello");
    e.preventDefault();
});  */ 



    $('body').on("submit",'.form-js',function(e){
        e.preventDefault();

        const url = this.getAttribute('action');
        
        const postId = this.querySelector('#post-id-js').value;
        const count = this.querySelector('#count-js');
        
        
      
        
        
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
                
                
            },
            method: 'post',
            body: JSON.stringify({
                id: postId
            })
        }).then(response => {
             response.json().then(data => {
                if(data.count == 'not'){
                    window.location.replace("/login");
                }else{
                    count.innerHTML = data.count
                }
                
            }) 
        }).catch(error => {
            console.log(error)
        }); 
    })
       

   
