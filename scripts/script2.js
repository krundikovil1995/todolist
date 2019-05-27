$(document).ready(function () {


    //создание нового таска
    $('#create').submit(function (e) {
        e.preventDefault();

        let $this = $(this);
        let task = $this.find('#mytask').val();
        let status = $this.find('#status').val();
        let date = $this.find('#date').val();

        $.ajax({
            type: "POST",
            url: 'createtask.php',
            data: {task, status, date},
            success: function (result) {

                if (JSON.parse(result) == true)
                    window.location.replace('http://localhost:8080/test/todolist/list.php')
                else
                    $('div#result').html(JSON.parse(result));
            }
        });
        return false;
    });

    //перенос таска в другой статус (doing, done)
    $('td.move').find('p').click(function (e) {
        let move = $(this).text();
        $.ajax({
            type: "POST",
            url: 'move.php',
            data: {move},
            success: function (result) {
                window.location.replace('http://localhost:8080/test/todolist/list.php')
            }
        });
        return false;
    });

    //удаление таска
    $('td.delete').click(function (e) {
        let del = $(this).text();
        $.ajax({
            type: "POST",
            url: 'delete.php',
            data: {del},
            success: function (result) {
                window.location.replace('http://localhost:8080/test/todolist/list.php')
            }
        });
        return false;
    });

    //выплывающее поле, в какой статус переносить наш таск
    $(function () {
        $('td.move').find('p').hide();
        $('td.move').hover(
            function () {
                $(this).find('p').slideDown(700);
            }, function () {
                $(this).find('p').slideUp(700);
            });
    });

    //выход из кабинета и конец сессии
    $('p.logout').click(function () {
        $.ajax({
            url: 'logout.php',
            success: function () {
                window.location.replace('http://localhost:8080/test/todolist')
            }
        });
        return false;
    });
})