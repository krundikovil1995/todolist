$(document).ready(function () {

    //авторизация
    $('#signin').submit(function (e) {
        e.preventDefault();

        let $this = $(this);
        let name = $this.find('#name').val();
        let email = $this.find('#email').val();
        let key = $this.find('#key').val();

        $.ajax({
            type: "POST",
            url: 'signin.php',
            data: {name, email, key},
            success: function (result) {
                if (JSON.parse(result) == true)
                    window.location.replace('http://localhost:8080/test/todolist/list.php')
                else
                    $('div#result').html(JSON.parse(result));
            }
        });
        return false;
    })
})