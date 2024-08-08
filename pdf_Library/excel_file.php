<?php

$html = "<table>
    <tr>
        <th>
            hello world
        </th>
    </tr>
</table>";

    header('content-type:application/xls');
    header('content-Disposition:attachment; filename=regular.xls');

    echo $html;
?>