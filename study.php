<?php
fscanf(STDIN, "%d %d %d %d %d %d %d %d %d %d", $a[0], $a[], $a[], $a[], $a[], $a[], $a[], $a[], $a[], $a[]);
fscanf(STDIN, "%d", $h);
$amount = 0;
for ($i = 0; $i < 10; $i++)
    if ($h + 30 >= $a[$i])
        $amount++;
echo $amount;
?>