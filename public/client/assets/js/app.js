
function runCodejs(){

    qr();

    if(time_over_exam != null && time_now_exam != null){
        completeExam();
    }

    showExercise(); 

    handleStar();

    boughtNowBook();

}

runCodejs();

function completeExam(){

    if(time_over_exam != null && time_now_exam != null){

        let time_finish_exam = time_over_exam - time_now_exam;

        let second = time_finish_exam;

        let coundown_exam = document.querySelector('.coundown_exam');

        setInterval(()=>{
            var hours = Math.floor(second / 3600);
            var minutes = Math.floor((second % 3600) / 60);
            var seconds = second % 60;
            coundown_exam.innerHTML = `${hours} <span class="text-warning">:</span> ${minutes} <span class="text-warning">:</span> ${seconds}`;
            second--;
        }, 1000);

        time_finish_exam = time_finish_exam*1000;

        let btn_complete_exam = document.querySelector('.btn_complete_exam');
        console.log(btn_complete_exam);
    
        if(btn_complete_exam != null){
            console.log(123);
            setTimeout(()=>{
                btn_complete_exam.click();
            }, time_finish_exam);

        }

    }
        
}



function qr(){

    const qrText=document.getElementById('qr_text');
    const generate=document.getElementById('generate');
    const qrcodebox=document.querySelector('.body-qr');

    if(qrText != null && generate != null && qrcodebox != null){
        generate.addEventListener('click',(e)=>{
        e.preventDefault();
        isEmptyInput();
        });

        setTimeout(()=>{
                generate.click();
        }, 1000);

        function isEmptyInput(){
            qrText.value.length>0?generateQRCode():'';
        }
        
        function generateQRCode(){
            qrcodebox.innerHTML = "";
            new QRCode(qrcodebox, {
                text:qrText.value,
                // height:'100',
                // width:'100',
                colorLight:"#fff",  
                colorDark:"#000",
            });
        }
    }

}

function showExercise(){

    let all_ex_chapter = document.querySelectorAll('.ex_chapter');
    let all_ex_exercise = document.querySelectorAll('.ex_exercise');

    let count = 0;

    if(all_ex_chapter != null && all_ex_exercise != null){
        all_ex_chapter.forEach((item, index)=>{
        item.addEventListener('click', ()=>{
            let ex_exercise = all_ex_exercise[index];
            count++;
            if(count%2 == 0){
                ex_exercise.style.display = 'none';
            }else if(count%2 != 0){
                ex_exercise.style.display = 'block';
                ex_exercise.style.transition ='all 1s';
            }
        });
    });
    }

}

function handleStar(){

    let all_item_rating = document.querySelectorAll('.item_rating');
    let all_star = document.querySelectorAll('.star');

    if(!all_item_rating != null && all_star != null){
        all_star.forEach((item, index)=>{
            item.addEventListener('click', ()=>{
                for (let j = 0; j <= 4; j++) {
                    all_star[j].style.color = "black";
                }
                for (let i = 0; i <= index; i++) {
                    all_star[i].style.color = "#ffc107";
                }
                console.log(all_item_rating[index]);
                all_item_rating[index].checked = true;
            });
        });
    }

}

function boughtNowBook(){

    let add_book = document.querySelector('.add_book');
    let quantity_book = document.querySelector('.quantity_book');
    let minus_book = document.querySelector('.minus_book');

    if(add_book != null && quantity_book != null && minus_book != null){
        let quantity = 0;
        add_book.addEventListener('click', ()=>{
            quantity += 1;
            if(quantity >= 10) quantity = 10;
            quantity_book.value = quantity;
        });
        minus_book.addEventListener('click', ()=>{
            quantity -= 1;
            if(quantity <= 0 ) quantity = 0;
            quantity_book.value = quantity;
        });
    }

}








