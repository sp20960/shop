<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de pedido</title>
</head>
<body style="margin:0; padding:0; background-color:#f3f4f6; font-family: Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f3f4f6; padding:20px 0;">
    <tr>
        <td align="center">

            <!-- Contenedor -->
            <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden;">

                <!-- Header -->
                <tr>
                    <td style="background-color:#4f46e5; padding:24px; text-align:center; color:#ffffff;">
                        <h1 style="margin:0; font-size:24px;">¡Pedido confirmado! 🎉</h1>
                        <p style="margin:6px 0 0; font-size:14px;">
                            Gracias por tu compra
                        </p>
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding:24px; color:#374151; font-size:14px;">

                        <p style="margin:0 0 12px;">
                            Hola <strong><?= htmlspecialchars($_SESSION['user']['customerName']) ?></strong>,
                        </p>

                        <p style="margin:0 0 20px;">
                            Hemos recibido correctamente tu pedido
                            <strong>#<?= $orderNumber ?></strong>.
                        </p>

                        <!-- Resumen pedido -->
                        <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #e5e7eb; border-radius:6px;">

                            <tr>
                                <td colspan="2" style="background-color:#f9fafb; padding:10px; font-weight:bold;">
                                    Resumen del pedido
                                </td>
                            </tr>
                            <?php foreach ($ordersInfo as $producto): ?>
                            <tr>
                                <td style="padding:10px; border-top:1px solid #e5e7eb;">
                                    <?= htmlspecialchars($producto['productName']) ?> 
                                    <span style="color:#6b7280;">
                                        x<?= $producto['quantity'] ?>
                                    </span>
                                </td>
                                <td align="right" style="padding:10px; border-top:1px solid #e5e7eb;">
                                    <?= number_format($producto['productUnitPrice'], 2) ?> €
                                </td>
                            </tr>
                            <?php endforeach; ?>

                            <tr>
                                <td style="padding:12px; font-weight:bold; background-color:#f9fafb;">
                                    Total
                                </td>
                                <td align="right" style="padding:12px; font-weight:bold; background-color:#f9fafb;">
                                    <?= number_format($total, 2) ?> €
                                </td>
                            </tr>

                        </table>

                        <p style="margin:20px 0;">
                            Te avisaremos cuando tu pedido sea enviado 🚚
                        </p>

                        <!-- Botón -->
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center" style="padding-top:10px;">
                                    <a href="https://remotehost.es/student023/shop/backend/customer/my_orders.php?order=<?= $orderNumber ?>"
                                       style="background-color:#4f46e5;
                                              color:#ffffff;
                                              text-decoration:none;
                                              padding:12px 20px;
                                              border-radius:6px;
                                              display:inline-block;
                                              font-weight:bold;">
                                        Ver mi pedido
                                    </a>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="background-color:#f9fafb; text-align:center; padding:16px; font-size:12px; color:#6b7280;">
                        © <?= date('Y') ?> Riff Store · Todos los derechos reservados
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>
