<tr>
    <td><?= $order['id'] ?></td>
    <td><?php if ($order['timestamp']) echo rus_date("j F Y G:i", $order['timestamp']); ?></td>
    <td>
        <a href="<?php echo HOST . "admin/"; ?>order?id=<?= $order['id'] ?>">
            <?= $order['name'] ?>&nbsp;<?= $order['secondname'] ?>
        </a>
    </td>
    <td>
        <a href="<?php echo HOST . "admin/"; ?>order?id=<?= $order['id'] ?>">
            <?= $order['email'] ?>
        </a>
    </td>
    <td>
        <a href="<?php echo HOST . "admin/"; ?>order?id=<?= $order['id'] ?>">
            <?= $order['status'] ?>
        </a>
    </td>
    <td>
        <?php
        if ($order['paid']) {
            echo "Оплачен";
        } else {
            echo "Не оплачен";
        }
        ?>
    <td>
        <a href="<?php echo HOST . "admin/"; ?>order?id=<?= $order['id'] ?>">
            <?= number_format($order['price'], 2, ',', ' ') ?> руб.
        </a>
    </td>
    <td><a href="<?php echo HOST . "admin/order-delete?id={$order['id']}"; ?>" class="icon-delete"></a></td>
</tr>