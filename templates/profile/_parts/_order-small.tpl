<tr>
    <td>
        <a href="<?php echo HOST . "profile-order"; ?>?id=<?= $order['id'] ?>">
            <?php if ($order['timestamp']) echo rus_date("j F Y G:i", $order['timestamp']); ?>
        </a>
    </td>
    <td>
        <a href="<?php echo HOST . "profile-order"; ?>?id=<?= $order['id'] ?>">
            <?= $order['status'] ?>
        </a>
    </td>
    <td>
        <?php
        if ($order['paid']) {
            echo "Оплачен";
        } else {
            echo "Не оплачен<br>";
            echo "<a class='secondary-button'>Оплатить</a>";
        }
        ?>
    <td>
        <a href="<?php echo HOST . "profile-order"; ?>?id=<?= $order['id'] ?>">
            <?= number_format($order['price'], 2, ',', ' ') ?> руб.
        </a>
    </td>
</tr>