
function runCodeJs(){

    ckediter();

    itemQuestionExam();

    checkAllPermission();

    quantityCart();

    removeCart();

    optionFooter();

    optionSlide();
    
}

runCodeJs();





// ckediter

function ckediter(){

let allCkediter = document.querySelectorAll('.ckediter');

if(allCkediter != null){
    allCkediter.forEach((item, index) => { 
        item.id = 'ckediter_'+index;
        CKEDITOR.replace(item.id);
    });
}

}


function itemQuestionExam(){


    let html_question_exam = `<div class="item_question row mx-0">

    <div class="col-11 row mx-0">
    
    <div class="form-group col-12 ">
        <label for="">Câu hỏi</label>
        <textarea name="message[]" id="" cols="30" rows="10" class="ckediter w-100"></textarea>
    </div>
    
    <div class="form-group col-6">
        <label for="">Đáp án 1</label>
        <input type="text" name="answer_1[]" class="form-control">
    </div>
    
    <div class="form-group col-6">
        <label for="">Đáp án 2</label>
        <input type="text" name="answer_2[]" class="form-control">
    </div>
    
    <div class="form-group col-6">
        <label for="">Đáp án 3</label>
        <input type="text" name="answer_3[]" class="form-control">
    </div>
    
    <div class="form-group col-6">
        <label for="">Đáp án 4</label>
        <input type="text" name="answer_4[]" class="form-control">
    </div>
    
    <div class="form-group col-12">
        <label for="">Đán án đúng</label>
        <input type="number" max="4" min="1" value="1" name="right_answer[]" class="form-control">
    </div>
    
    
    </div>
    
    
    <div class="col-1">
        <span class="btn btn-danger w-100 remove_question"><i class="fa fa-times"></i></span>
    </div>
    
    </div>`; 


    let add_question = document.querySelector('.add_question');
    let box_question = document.querySelector('.box_question');


    if(add_question != null && box_question != null){



        add_question.addEventListener('click', () => {

            let question_parser = new DOMParser().parseFromString(html_question_exam, 'text/html').querySelector('.item_question');

            box_question.appendChild(question_parser);

            ckediter();

            let remove_questions = box_question.querySelectorAll('.remove_question');

            if(remove_questions != null){
                remove_questions.forEach((item) => {
                    item.addEventListener('click', (e) => {
                        let remove = e.target;
                        while(true){
                            remove = remove.parentElement;
                            if(remove.classList.contains('item_question')) break;
                        }
                        remove.remove();
                    });
                });
            }
        });

        let remove_questions = box_question.querySelectorAll('.remove_question');

        if(remove_questions != null){
            remove_questions.forEach((item) => {
                item.addEventListener('click', (e) => {
                    let remove = e.target;

                    if(confirm('Are you sure remove !')){
                    while(true){
                        remove = remove.parentElement;
                        if(remove.classList.contains('item_question')) break;
                    }
                    remove.remove();  
                    }
                });
            });
        }
    }
}


function checkAllPermission() {

    let input_permission = document.querySelectorAll('.input_permission');
    let btn_all_permission = document.querySelector('.btn_all_permission');
    let btn_remove_permission = document.querySelector('.btn_remove_permission');

    if(input_permission != null && btn_all_permission != null){
        btn_all_permission.addEventListener('click', ()=>{
            input_permission.forEach((item)=>{
                item.checked = true;
            });
        });
    }

    if(input_permission != null && btn_remove_permission != null){
        btn_remove_permission.addEventListener('click', ()=>{
            input_permission.forEach((item)=>{
                item.checked = false;
            });
        });
    }

}


function quantityCart(){
    let all_btn_up_cart = document.querySelectorAll('.btn_up_cart');
    let all_quantity_cart = document.querySelectorAll('.quantity_cart');
    let all_btn_down_cart = document.querySelectorAll('.btn_down_cart');
    let all_price_bought_cart = document.querySelectorAll('.price_bought_cart');
    let all_sum_price_cart = document.querySelectorAll('.sum_price_cart');
    let total_price_cart = document.querySelector('.total_price_cart');
    let input_total_price_cart = document.querySelector('.input_total_price_cart');


    if(all_btn_up_cart != null && all_quantity_cart != null){
        all_btn_up_cart.forEach((btn_up, index)=>{
            let price_bought_cart = all_price_bought_cart[index].innerText;
            btn_up.addEventListener('click', ()=>{
                let quantity_cart = parseInt(all_quantity_cart[index].value) + 1;
                if(quantity_cart > 10) quantity_cart = 10;
                all_quantity_cart[index].value = quantity_cart;
                all_sum_price_cart[index].innerText = parseInt(price_bought_cart) * parseInt(all_quantity_cart[index].value);
                let total_price = 0;
                all_sum_price_cart.forEach((item)=>{
                    total_price += parseInt(item.innerText); 
                    total_price_cart.innerText = total_price;
                    input_total_price_cart.value = total_price;
                });
            });
        });
    }

    if(all_btn_down_cart != null && all_quantity_cart != null){
        all_btn_down_cart.forEach((btn_down, index)=>{
            let price_bought_cart = all_price_bought_cart[index].innerText;
            btn_down.addEventListener('click', ()=>{
                let quantity_cart = parseInt(all_quantity_cart[index].value) - 1;
                if(quantity_cart < 1) quantity_cart = 1;
                all_quantity_cart[index].value = quantity_cart;
                all_quantity_cart[index].value = quantity_cart;
                all_sum_price_cart[index].innerText = parseInt(price_bought_cart) * parseInt(all_quantity_cart[index].value);
                let total_price = 0;
                all_sum_price_cart.forEach((item)=>{
                    total_price += parseInt(item.innerText); 
                    total_price_cart.innerText = total_price;
                    input_total_price_cart.value = total_price;
                });
            });
        });
    }

}

function removeCart(){
    let all_btn_remove_cart = document.querySelectorAll('.btn_remove_cart');
    let all_id_remove = document.querySelectorAll('.id_remove');
    if(all_btn_remove_cart != null && all_id_remove != null){
        all_btn_remove_cart.forEach((btn_remove, index)=>{
            btn_remove.addEventListener('click', ()=>{
                all_id_remove[index].name = 'id_remove';
            });
        });
    }
}



function optionFooter(){


    let html_option_footer = `        
    <div class="item_footer row m-0">
    <div class="form-group col-11">
        <textarea name="footerH[]" id="" cols="30" rows="5" class="ckediter w-100"></textarea>
    </div>
    <div class="col-1">
        <span class="btn btn-danger w-100 remove_footer"><i class="fa fa-times"></i></span>
    </div>
    </div>`; 


    let add_footer = document.querySelector('.add_footer');
    let box_footer = document.querySelector('.box_footer');


    if(add_footer != null && box_footer != null){



        add_footer.addEventListener('click', () => {

            let footer_parser = new DOMParser().parseFromString(html_option_footer, 'text/html').querySelector('.item_footer');

            box_footer.appendChild(footer_parser);

            ckediter();

            let remove_footers = box_footer.querySelectorAll('.remove_footer');

            if(remove_footers != null){
                remove_footers.forEach((item) => {
                    item.addEventListener('click', (e) => {
                        let remove = e.target;
                        while(true){
                            remove = remove.parentElement;
                            if(remove.classList.contains('item_footer')) break;
                        }
                        remove.remove();
                    });
                });
            }
        });

        let remove_footers = box_footer.querySelectorAll('.remove_footer');

        if(remove_footers != null){
            remove_footers.forEach((item) => {
                item.addEventListener('click', (e) => {
                    let remove = e.target;

                    if(confirm('Are you sure remove !')){
                    while(true){
                        remove = remove.parentElement;
                        if(remove.classList.contains('item_footer')) break;
                    }
                    remove.remove();  
                    }
                });
            });
        }
    }
}

function optionSlide(){


    let html_option_slide = `<div class="item_slide row mx-0">
    <div class="form-group col-11">
        <input type="file" name="slide[]" id="" class="form-control">
    </div>
    <div class="col-1">
        <span class="btn btn-danger remove_slide w-100"><i class="fa fa-times"></i></span>
    </div>
    </div>`; 


    let add_slide = document.querySelector('.add_slide');
    let box_slide = document.querySelector('.box_slide');


    if(add_slide != null && box_slide != null){



        add_slide.addEventListener('click', () => {

            let slide_parser = new DOMParser().parseFromString(html_option_slide, 'text/html').querySelector('.item_slide');

            box_slide.appendChild(slide_parser);

            ckediter();

            let remove_slides = box_slide.querySelectorAll('.remove_slide');

            if(remove_slides != null){
                remove_slides.forEach((item) => {
                    item.addEventListener('click', (e) => {
                        let remove = e.target;
                        while(true){
                            remove = remove.parentElement;
                            if(remove.classList.contains('item_slide')) break;
                        }
                        remove.remove();
                    });
                });
            }
        });

        let remove_slides = box_slide.querySelectorAll('.remove_slide');

        if(remove_slides != null){
            remove_slides.forEach((item) => {
                item.addEventListener('click', (e) => {
                    let remove = e.target;

                    if(confirm('Are you sure remove !')){
                    while(true){
                        remove = remove.parentElement;
                        if(remove.classList.contains('item_slide')) break;
                    }
                    remove.remove();  
                    }
                });
            });
        }
    }
}



