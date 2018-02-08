<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Knowledge Hub';
?>
<?= Yii::$app->view->renderFile('@app/views/layouts/navbar.php') ?>

<div class="site-hub">
	<section id="hub" class="container">
		<div class="row">
			<div class="col-md-8">
				<h1 class="hub-header">
					<i class="fa fa-lightbulb-o" aria-hidden="true"></i>
					Knowledge Hub <span>: Knowledge Resources</span>
				</h1>
				<p class="description">The PPEI Knowledge Hub is a portal to PEI resources containing references and materials developed by Philippines PEI team. PPEI works with pool of experts helping the national and local governments in the development of materials such as Handbooks, Primers, Case Reviews, Policy Papers, etc.</p>

				<!-- Hub Content Starts -->
				<p>PPEI-Ph1 knowledge products scoping the work for PPEI-Ph2 are the following:</p>

				<h2>Analytical Studies/ Policy reforms, 3</h2>
				<ul>
					<li><a href="#">Review of Collection and Distribution of Revenues from Natural Resources (2011)</a></li>
					<li><a href="#">Philippine Public Environmental Expenditure Review at National and Local Levels (2011)</a></li>
					<li><a href="#">Encouraging Policy Reforms and Improving Governance Processes to Facilitate Timely Release of ENR Revenues to LGUs and to Improve the Poverty Benefits from ENR (2012)</a></li>
				</ul>
				<h2>Advocacy education, 4</h2>
				<ul>
					<li><a href="#">Advocacy and Support for the Introduction of EITI in the Philippines (2011 - 2012)</a></li>
					<li><a href="#">Advocacy Paper on Increasing Environment and Natural Resources-related Allocation for Poverty Alleviation and Environmental Sustainability (2012)</a></li>
				</ul>
				<h2>PED integration and method dev’t., 6</h2>
				<ul>
					<li>
					 Review of Utilization of Revenues from Natural Resources and Application of Best Practices and Media Strategy.
						<ul>
							<li><a href="#">3 case studies in 2011</a></li>
							<li><a href="#">Additional 9 cases in 2012</a></li>
						</ul>
					</li>
					<li><a href="#">Philippines’ Handbook on Mainstreaming Poverty-Environment Linkages in Local Governance (2012)</a></li>
				</ul>
				<h2>Planning Instruments / Tools, 2</h2>
				<ul>
					<li><a href="#">Capacity Assessment Tool on Mainstreaming P-E Linkages in Local Governance (2012)</a></li>
					<li><a href="#">National Award for LGUs on Mainstreaming P/E Linkages : Award on Exemplary Performance on PEI and Contribution to Economy (2012)</a></li>
				</ul>
				<h2>Position Papers / Research Papers, 5</h2>
				<ul>
					<li><a href="#">Paper on the Relationship of Gross Production Value of Mining companies to their Total Exports (2012)</a></li>
					<li><a href="#">Position Paper on Amending the Local Government Code or RA 7160 to give LGUs more flexibility in utilizing their shares in NW</a></li>
					<li><a href="#">Position Paper on Amending the  EPIRA or RA 9136 and Renewable Energy (RE) Act or RA 9512 to increase the share of LGUs in NW</a></li>
				</ul>
			</div>
			<div class="col-md-4">
				<div id="publications" class="card">
					<h4 class="card-header bg-transparent">
						Publications
						<i class="fa fa-book" aria-hidden="true"></i>
					</h4>
					<div class="card-body">
						<p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus consectetur soluta possimus, maxime saepe harum non veniam delectus perferendis mollitia aut nesciunt neque culpa consequuntur error, atque distinctio officiis odit.</p>
					</div>
				</div>

				<div id="policy-briefs" class="card">
					<h4 class="card-header bg-transparent">
						Policy Briefs
						<i class="fa fa-certificate" aria-hidden="true"></i>
					</h4>
					<div class="card-body">
						<p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus consectetur soluta possimus, maxime saepe harum non veniam delectus perferendis mollitia aut nesciunt neque culpa consequuntur error, atque distinctio officiis odit.</p>
					</div>
				</div>

				<div id="presentation-materials" class="card">
					<h4 class="card-header bg-transparent">
						Presentation Materials
						<i class="fa fa-file" aria-hidden="true"></i>
					</h4>
					<div class="card-body">
						<p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus consectetur soluta possimus, maxime saepe harum non veniam delectus perferendis mollitia aut nesciunt neque culpa consequuntur error, atque distinctio officiis odit.</p>
					</div>
				</div>

				<div id="speeches" class="card">
					<h4 class="card-header bg-transparent">
						Speeches
						<i class="fa fa-comment" aria-hidden="true"></i>
					</h4>
					<div class="card-body">
						<p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus consectetur soluta possimus, maxime saepe harum non veniam delectus perferendis mollitia aut nesciunt neque culpa consequuntur error, atque distinctio officiis odit.</p>
					</div>
				</div>

			</div>
		</div>
	</section>
</div>

<?= Yii::$app->view->renderFile('@app/views/layouts/footer.php') ?>