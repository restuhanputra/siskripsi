<table align="center" style="width: 700px;">
	<tr>
		<td style="text-align: center;">
			<img width="18%" src="<?= './assets/kop/ubj.png' ?>">
		</td>
		<td style="width: 82%; font-family: Verdana; font-size: x-small; text-align: center;">

			<b style="font-size: 20px">UNIVERSITAS BHAYANGKARA JAKARTA RAYA</b>
			<br><b style="font-size: 16px">Jl. Darmawangsa I No. 1 Kebayoran Baru , Jakarta 12140</b>
			<br><b style="font-size: 16px">Telepon : (021) 7267655, 7267657, 7231948, Fax : (021) 7267657</b>
			<br><b style="font-size: 16px">Jl. Perjuangan, Bekasi Utara</b>
			<br><b style="font-size: 16px">Telepon : (021) 88955882, Fax : (021) 88955871</b>
		</td>
	</tr>

</table>
<table align="center" style="width: 100%;">
	<tr>
		<td colspan="2" style="border: 0px solid #000; border-width: 1px 0 1px 0; padding: 1px">
		</td>
	</tr>
</table>

<br>
<br>
<table align="center" style="width: 100%;">
	<tr>
		<td style="text-align: center;">
			<b style="font-size: 20px">LAPORAN BIMBINGAN SKRIPSI
				<?php
				if (isset($tahun_akademik)) {
					foreach ($g_thn_akdmk as $data) :
						$tahun_akademik_id = $data['tahun_akademik_id'];
						$tahun             = $data['tahun'];
						$semester          = $data['semester'];

						if ($tahun_akademik == $tahun_akademik_id) {
							echo $tahun;
							echo  $semester == 1 ? " (GANJIL)" : " (GENAP)";
						}
					endforeach;
				} else {
					echo "";
				}
				?>
			</b>
		</td>
	</tr>
</table>
<br>
<br>

<style>
	table.minimalistBlack {
		background-color: #FFFFFF;
		width: 100%;
		text-align: left;
		border-collapse: collapse;
	}

	table.minimalistBlack td,
	table.minimalistBlack th {
		border: 1px solid #000000;
	}

	table.minimalistBlack thead {
		background: #CFCFCF;
		background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
		background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
		background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
	}

	table.minimalistBlack thead th {
		/* font-size: 15px; */
		font-weight: bold;
		color: #000000;
		text-align: center;
	}
</style>

<table class="minimalistBlack" style="width:100%;">
	<thead>
		<tr>
			<th style="width:1%;">No</th>
			<th>NPM</th>
			<th>Nama Mahasiswa</th>
			<th>Pembimbing I</th>
			<th>Pembimbing II</th>
			<th>Judul Skripsi</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if (!empty($g_bbg)) {
			$no = 1;
			foreach ($g_bbg as $data) :
				$npm            = $data['npm'];
				$nama_lkp       = ucfirst($data['nama_lkp']);
				$pbb_satu       = $data['pbb_satu'];
				$pbb_dua        = $data['pbb_dua'];
				$judul_proposal = $data['judul_proposal'];
				$status         = $data['status'];
		?>
				<tr>
					<td><?= $no++ ?>.</td>
					<td><?= $npm ?></td>
					<td><?= $nama_lkp ?></td>
					<td>
						<?php
						if (!empty($pbb_satu)) {
							foreach ($g_dosen as $data) :
								$nidn     = $data['nidn'];
								$nama_dsn = strtoupper($data['nama_lkp']);

								if ($pbb_satu == $nidn) {
									echo $nama_dsn;
								}
							endforeach;
						} else {
							echo "";
						}
						?>
					</td>
					<td>
						<?php
						if (!empty($pbb_dua)) {
							foreach ($g_dosen as $data) :
								$nidn     = $data['nidn'];
								$nama_dsn = strtoupper($data['nama_lkp']);

								if ($pbb_dua == $nidn) {
									echo $nama_dsn;
								}
							endforeach;
						} else {
							echo "";
						}
						?>
					</td>
					<td><?= $judul_proposal ?></td>
					<td align="center">
						<?php
						if ($status == 2) {
							echo "SELESAI BIMBINGAN";
						} else {
							echo "BIMBINGAN";
						}
						?>
					</td>
				</tr>
		<?php
			endforeach;
		} else {
			NULL;
		}
		?>
	</tbody>
</table>

<br>

<table style="width:100%">
	<tbody>
		<tr>
			<td style="width:72%">&nbsp;</td>
			<td style="width:28%" align="center">
				Bekasi, <?= $d_tanggal ?>
				<br />
				Ketua Program Studi Teknik Informatika
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<strong><u><?= $kaprodi ?></u></strong>
			</td>
		</tr>
	</tbody>
</table>
