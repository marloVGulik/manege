<?php

function getAllStudents() 
{
	return DBcommand('SELECT * FROM student', []);
}
