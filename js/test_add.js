if (typeof questionNm !== 'undefined') {
    let questionNm = 1;
    let resultNum = 1;
} else {
    questionNm = 1;
    resultNum = 1;
}

$(document).on('click', '.addAnswer', function () {
    let question = $(this).data('question');
    let answer = $(this).data('answer');
    let answerBlock = $(this).parents('.answers').find('.answer-items');
    answer++;
    $(this).data('answer', answer);

    answerBlock.append(`<div class="divider">
                            <label for="answer_text_${question}_${answer}" class="form-label">Ответ #${answer}</label>
                            <input type="text" name="answer_text_${question}_${answer}" id="answer_text_${question}_${answer}" class="form-control">
                        </div>
                        <div class="mt-2">
                            <label for="answer_score_${question}_${answer}" class="form-label">Балл за ответ #${answer}</label>
                            <input type="text" name="answer_score_${question}_${answer}" id="answer_score_${question}_${answer}" class="form-control">
                        </div>`);
});
$('.addQuestion').on('click', function () {
    questionNm++;
    let questionBlock = $('.question-items');

    questionBlock.append(`
                <div class="mt-4">
                    <label for="question_${questionNm}" class="form-label">Вопрос #${questionNm}</label>
                    <input type="text" name="question_${questionNm}" id="question_${questionNm}" class="form-control">
                    <div class="answers">
                        <div class="answer-items">
                        </div>
                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-light border addAnswer" data-question="${questionNm}" data-answer="0">Добавить вариант ответа</button>
                        </div>
                    </div>
                </div>`);
});
$(document).on('click', '.addResult', function () {
    resultNum++;
    let resultBlock = $('.result-items');

    resultBlock.append(`
                    <div class="mt-4 divider">
                        <div class="">
                            <label for="result_${resultNum}" class="form-label">Результат #${resultNum}</label>
                            <textarea name="result_${resultNum}" id="result_${resultNum}" class="form-control"></textarea>
                        </div>
                        <div class="mt-2">
                            <label for="result_score_min_${resultNum}" class="form-label">Балл (от) #${resultNum}</label>
                            <input type="text" name="result_score_min_${resultNum}" id="result_score_min_${resultNum}" class="form-control">
                        </div>
                        <div class="mt-2">
                            <label for="result_score_max_${resultNum}" class="form-label">Балл (до) #${resultNum}</label>
                            <input type="text" name="result_score_max_${resultNum}" id="result_score_max_${resultNum}" class="form-control">
                        </div>
                    </div>`);
});