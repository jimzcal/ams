<?php

?>
<div id="components-calendar">
	<h1 class="cal-header">
		<i class="fa fa-calendar" aria-hidden="true"></i>
		Calendar of Activities
	</h1>
	<div id="mini-clndr">
		<script id="mini-clndr-template" type="text/template">
			<div class="controls">
				<div class="clndr-previous-button">&lsaquo;</div>
				<div class="month-year"><%= month %> | <%= year %></div>
				<div class="clndr-next-button">&rsaquo;</div>
			</div>
			<div class="clndr-content">
				<div class="days-container">
					<div class="headers">
						<% _.each(daysOfTheWeek, function(day) { %>
							<div class="day-header"><%= day %></div>
						<% }); %>
					</div>
					<div class="days-list">
						<% _.each(days, function(day) { %>
							<div class="<%= day.classes %>" id="<%= day.id %>"><%= day.day %></div>
						<% }); %>
					</div>
				</div>
				<div class="events-container">
					<div class="headers">
						<div class="x-button">x</div>
						<div class="event-header">Activities</div>
					</div>
					<div class="events-list">
						<% _.each(eventsThisMonth, function(event) { %>
							<div class="event">
								<h6><%= moment(event.date).format('MMMM Do') %>: <a href="<%= event.url %>"><%= event.title %></a></h6> 
							</div>
						<% }); %>
					</div>
				</div>
			</div>
		</script>
	</div>
</div>
