/**

 * @property {HTMLElement} content
 
 * @property {HTMLFormElement} form
  * @property {HTMLFormElement} form2
 */
class Filter {

    /**
     * @param {HTMLElement|null} element
     */
    constructor () {
     
      
        /* this.content = document.querySelector('.js-filter-content') */
        this.form = document.querySelector('.js-filter-form')
        this.form2=document.querySelector('.js-filter-form-2')
        this.form3=document.querySelector('.js-filter-form-3') 
        /* this.form4=document.querySelector('.js-filter-form-4') */
        
        /* this.reset = document.querySelector('#reset') 
         */
        
        this.bindEvents() 
    }
  
    /**
     * Ajoute les comportements aux différents éléments
     */
    bindEvents () {
      
      const aClickListener = e => {
        if (e.target.tagName === 'A') {
          e.preventDefault()
          this.loadUrl(e.target.getAttribute('href'))
        }
      }
      
     /*  $('body').on("click",'#reset',aClickListener) */
      
      $('body').on("change",'.js-filter-form',this.loadForm.bind(this)) 
      $('body').on("change",'.js-filter-form-2',this.loadForm.bind(this))
      $('body').on("change",'.js-filter-form-3',this.loadForm.bind(this)) 
      
    

    }
  
    async loadForm () {
      /* console.log(number); */
      const data = new FormData(this.form)
      const data2 = new FormData(this.form2)
     const data3 = new FormData(this.form3) 
      /* const data4 = new FormData(this.form4) */
      
      
      const params = new URLSearchParams()
      
      if( $(".js-filter-form").hasClass('active')){
        data.forEach((value, key) => {
          params.append(key, value)
  
        })
      }
    
      
      data2.forEach((value, key) => {
        params.append(key, value)
      })
     
      if($(".js-filter-form-3").hasClass('active')){
        data3.forEach((value, key) => {
          params.append(key, value)
        }) 
      } 
     
   
      return this.loadUrl('/assets' + '?' + params.toString()) 
    }
  
    async loadUrl (url) {
      
      const ajaxURL=url+"&ajax=1"
      const response = await fetch(ajaxURL, {
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      if (response.status >= 200 && response.status < 300) {
        const data = await response.json()
        /* this.content.innerHTML=data.content */
        $('.js-filter-content').html(data.content)
        $('#nb_items').html(data.nb_items)
        history.replaceState({},'',url)
        
      } else {
        console.error(response)
      }
     
    }


  
  
  
   
}

/* const main = document.querySelector('.js-filter');
console.log(main.querySelector('.js-filter-form')); */

new Filter();  