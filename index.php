<?php
$matkul = [
    ["nama" => "Pemrograman Web", "sks" => 3, "nilai" => 89],
    ["nama" => "Struktur Data", "sks" => 3, "nilai" => 78],
    ["nama" => "Kalkulus", "sks" => 2, "nilai" => 58],
    ["nama" => "Jaringan Komputer", "sks" => 3, "nilai" => 85],
    ["nama" => "Sistem Digital", "sks" => 2, "nilai" => 91]
];

function hitungBobot($nilai)
{
    if ($nilai >= 80) {
        return ["huruf" => "A", "bobot" => 4.0];
    } elseif ($nilai >= 70) {
        return ["huruf" => "B", "bobot" => 3.0];
    } elseif ($nilai >= 60) {
        return ["huruf" => "C", "bobot" => 2.0];
    } elseif ($nilai >= 50) {
        return ["huruf" => "D", "bobot" => 1.0];
    } else {
        return ["huruf" => "E", "bobot" => 0.0];
    }
}

$totalSKS = 0;
$totalMutu = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Nilai Mata Kuliah</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 30px;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #243b64;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        th {
            background-color: #243b64;
            color: white;
            padding: 12px 8px;
        }

        td {
            border: 1px solid #ddd;
            padding: 11px 8px;
            text-align: center;
        }

        td:nth-child(2) {
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f8f9fc;
        }

        .mengulang {
            background-color: #ffdede !important;
            color: #b30000;
        }

        .ringkasan {
            background-color: #eef2f8;
            padding: 18px;
            border-radius: 8px;
            line-height: 1.8;
        }

        .ringkasan p {
            margin: 5px 0;
        }

        @media (max-width: 700px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 12px;
                overflow-x: auto;
            }

            table {
                min-width: 700px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Daftar Nilai Mata Kuliah</h1>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Nilai</th>
                <th>Nilai Huruf</th>
                <th>Bobot</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($matkul as $index => $m): ?>
                <?php
                    $hasil = hitungBobot($m["nilai"]);
                    $huruf = $hasil["huruf"];
                    $bobot = $hasil["bobot"];

                    $status = ($bobot >= 2.0)
                        ? "LULUS"
                        : "MENGULANG";

                    $totalSKS += $m["sks"];
                    $totalMutu += $m["sks"] * $bobot;
                ?>

                <tr class="<?= $status == 'MENGULANG' ? 'mengulang' : '' ?>">
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($m["nama"]) ?></td>
                    <td><?= $m["sks"] ?></td>
                    <td><?= $m["nilai"] ?></td>
                    <td><?= $huruf ?></td>
                    <td><?= number_format($bobot, 1) ?></td>
                    <td><?= $status ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php
        $ips = ($totalSKS > 0)
            ? $totalMutu / $totalSKS
            : 0;

        $maksSKS = ($ips >= 3.00) ? 24 : 20;
    ?>

    <div class="ringkasan">
        <p><strong>Total Mata Kuliah:</strong>
            <?= count($matkul) ?>
        </p>

        <p><strong>Total SKS:</strong>
            <?= $totalSKS ?>
        </p>

        <p><strong>Total Mutu:</strong>
            <?= number_format($totalMutu, 2, ',', '.') ?>
        </p>

        <p><strong>IPS:</strong>
            <?= number_format($ips, 2, ',', '.') ?>
        </p>

        <p><strong>Maksimal SKS Semester Berikutnya:</strong>
            <?= $maksSKS ?> SKS
        </p>
    </div>

</div>
</body>
</html>