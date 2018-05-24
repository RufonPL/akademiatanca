<?php $courses = get_user_courses(true, false); ?>
<div class="row account-courses">
	<?php if($courses) : ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nr kursu</th>
                    <th>Nazwa</th>
                    <th>Poziom</th>
                    <th>Dni</th>
                    <th>Godziny</th>
                    <th>Data</th>
                    <th>Miejsce</th>
                    <th>Instructor</th>
                    <th>Ilość zajęć</th>
                    <th>Cena (PLN)</th>
                    <th>Płatność</th>
                    <th>Zapłacono</th>
                    <th>Notatka</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($courses as $course) : ?>
            	<?php 
				$note = $course['note'] != '' ? 
				'<div class="course-note">
					<!--<a href="#" class="see-note"><i class="fa fa-eye"></i></a>-->
					<div class="note-content">'.$course['note'].'</div>
				</div>' 
				: 'brak'; 
				?>
            	<tr>
                	<td><?php echo $course['number']; ?></td>
                	<td><?php echo $course['name']; ?></td>
                	<td><?php echo $course['level']; ?></td>
                    <td>
                    <?php foreach(unserialize($course['days_times']) as $day => $time) : ?>
                        <p class="no-margin no-wrap"><?php echo $day; ?></p>
                    <?php endforeach; ?>
                    </td>
                    <td>
                    <?php foreach(unserialize($course['days_times']) as $day => $time) : ?>
                        <p class="no-margin no-wrap"><?php echo $time; ?></p>
                    <?php endforeach; ?>
                    </td>
                	<td><?php echo $course['date']; ?></td>
                	<td><?php echo $course['place']; ?></td>
                	<td><?php echo $course['instructor']; ?></td>
                	<td><?php echo $course['lessons']; ?></td>
                	<td><?php echo $course['price']; ?></td>
                	<td><?php echo $course['payment']; ?></td>
                	<td><?php echo $course['paid']; ?></td>
                	<td><?php echo $note; ?></td>
                </tr>
            <?php endforeach; ?>
    		</tbody>
        </table>
    </div><!--end table responsive-->
    <?php else : ?>
    <h5 class="bold">Brak</h5>
    <?php endif; ?>
</div><!--end row-->