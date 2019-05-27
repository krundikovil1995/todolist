<?php
require_once('configs/config.php');
session_start();
$name = $_SESSION['user'];
$email = $_SESSION['email'];
//выборка данных из бд
$mysql = new mysqli($db['host'], $db['name'], $db['pass'], $db['db']);
$sql = "SELECT todo.id, todo.task, todo.date, todo.status_id FROM todo JOIN user ON todo.user_id = user.id WHERE user.email='$email' ORDER BY `date` ASC";
$result = $mysql->query($sql);

while ($row = $result->fetch_assoc()) {
    $array[] = $row;
}
if (!empty($array)) {
    $count = count($array);
    for ($i = 0; $i < $count; $i++) {

        if ($array[$i]['status_id'] == '1') {
            $res['todo'][] = $array[$i];
        } else if ($array[$i]['status_id'] == '2') {
            $res['doing'][] = $array[$i];
        } else if ($array[$i]['status_id'] == '3') {
            $res['done'][] = $array[$i];
        }
    }
} else $res[] = '';

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>My todo list</title>
    <META CHARSET="UTF-8">
    <link href="styles/style.css" rel="stylesheet">
</head>
<body>
<h2 class="title">My toDO list</h2>
<div class="welcome"> Hi, <?php echo $name; ?></div>
<p class="logout">logout</p>
<div id="mainlist">
    <table class="todo">
        <caption class="capt">Todo</caption>
        <?php if (isset($res['todo'])): ?>
            <?php foreach ($res['todo'] as $key => $value): ?>
                <tr>
                    <td class="id"> <?php echo $key + 1 ?> </td>
                    <td class="task"> <?php echo $res['todo'][$key]['task'] ?> </td>
                    <td class="date"> <?php echo $res['todo'][$key]['date'] ?> </td>
                    <td class="delete"> delete <font style="font-size:0px"><?php echo $res['todo'][$key]['id'] ?></font>
                    </td>
                    <td class="move"> move
                        <p class="movedoing">doing <font style="font-size:0px"><?php echo $res['todo'][$key]['id'] ?>
                                2</font></p>
                        <p class="movedone">done <font style="font-size:0px"><?php echo $res['todo'][$key]['id'] ?>
                                3</font></p>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td class="id"> id</td>
                <td class="task"> Task</td>
                <td class="date"> Date</td>
                <td> delete</td>
                <td class="move"> move</td>
            </tr>
        <?php endif; ?>
    </table>
    <table class="doing">

        <caption class="capt">doing</caption>
        <?php if (isset($res['doing'])): ?>
            <?php foreach ($res['doing'] as $key => $value): ?>
                <tr>
                    <td class="id"> <?php echo $key + 1 ?> </td>
                    <td class="task"> <?php echo $res['doing'][$key]['task'] ?> </td>
                    <td class="date"> <?php echo $res['doing'][$key]['date'] ?> </td>
                    <td class="delete"> delete <font
                                style="font-size:0px"><?php echo $res['doing'][$key]['id'] ?></font></td>
                    <td class="move"> move
                        <p class="movetodo">todo <font style="font-size:0px"><?php echo $res['doing'][$key]['id'] ?>
                                1</font></p>
                        <p class="movedone">done <font style="font-size:0px"><?php echo $res['doing'][$key]['id'] ?>
                                3</font></p>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td class="id"> id</td>
                <td class="task"> Task</td>
                <td class="date"> Date</td>
                <td> delete</td>
                <td class="move"> move</td>
            </tr>
        <?php endif; ?>
    </table>
    <table class="done">
        <caption class="capt">done</caption>
        <?php if (isset($res['done'])): ?>
            <?php foreach ($res['done'] as $key => $value): ?>
                <tr>
                    <td class="id"> <?php echo $key + 1 ?> </td>
                    <td class="task"> <?php echo $res['done'][$key]['task'] ?> </td>
                    <td class="date"> <?php echo $res['done'][$key]['date'] ?> </td>
                    <td class="delete"> delete <font style="font-size:0px"><?php echo $res['done'][$key]['id'] ?></font>
                    </td>
                    <td class="move"> move
                        <p class="movetodo">todo <font style="font-size:0px"><?php echo $res['done'][$key]['id'] ?>
                                1</font></p>
                        <p class="movedoing">doing <font style="font-size:0px"><?php echo $res['done'][$key]['id'] ?>
                                2</font></p>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td class="id"> id</td>
                <td class="task"> Task</td>
                <td class="date"> Date</td>
                <td> delete</td>
                <td class="move"> move</td>
            </tr>
        <?php endif; ?>
    </table>
</div>

<div id="result"></div>

<div class="createtask">
    <form id="create" method="post">
        <input type="text" id="mytask" name="mytask" placeholder="My Task:"/>
        <p>Status: 1 - todo, 2 - doing, 3 - done</p>
        <input type="number" min="1" max="3" id="status" name="status" placeholder="Status:"/>
        <input type="datetime-local" name="date" id="date">
        <input type="submit" class="submit" value="Create" name="create"/>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="scripts/script2.js" type="text/javascript"></script>
</body>
</html>