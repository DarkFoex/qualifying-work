let imgNum = 1;
let textNum = 1;

$('.addQuestion').on('click', function() {
    textNum++;
    let ParaBlock = $('.para-items');

    ParaBlock.append(`
                <div class="mt-4">
                    <label for="text_${textNum}" class="form-label">Параграф #${textNum}</label>
                    <input type="text" name="text_${textNum}" id="text_${textNum}" class="form-control">
                    
                </div>`);
});

$('.addPic').on('click', function() {
    imgNum++;
    let resultBlock = $('.result-items');

    resultBlock.append(`
                <div class="mt-4">
                            <div class="">
                                <label class="form-label" for="img_${imgNum}">Изображение #${imgNum}</label>
                                <input type="file" name="img_${imgNum}">
                            </div>
                        </div>`);
});