    <!-- Main content -->
    <section class="content">

    	<br>
    	<!-- row -->
    	<div class="row">
    		<div class="col-xs-12">

    			<!-- The time line -->
    			<ul class="timeline">
    				<?php
						if (isset($info)) {
							foreach ($info as $data) : ?>

    						<!-- timeline item -->
    						<li>
    							<i class="fa fa-bell bg-blue"></i>

    							<!-- <div class="box"> -->
    							<div class="timeline-item box-primary">
    								<span class="time"><i class="fa fa-clock-o"></i> <?= date('d M Y', strtotime($data['created'])); ?></span>

    								<h3 class="timeline-header text-bold"><?= $data['judul'] ?></h3>

    								<div class="timeline-body">
    									<p><?= $data['content'] ?></p>
    								</div>

    							</div> <!-- /.timeline-item -->
    							<!--</div>-->
    							<!-- /.box -->

    						</li>
    						<!-- END timeline item -->
    				<?php endforeach;
						} else {
							echo "404 not found";
						}
						?>
    				<li>
    					<i class="fa fa-genderless bg-gray"></i>
    				</li>
    			</ul>

    		</div>
    		<!-- /.col -->
    	</div>
    	<!-- /.row -->

    </section>
    <!-- /.content -->
