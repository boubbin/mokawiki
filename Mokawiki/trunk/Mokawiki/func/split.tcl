#! /bintclsh

set file [open functions.php r]
set data [read $file]
close $file
set function {}
set ispartoffunction 0
foreach i [split $data \n] {
		set firstword [lindex [split $i] 0]
		if {$firstword=="//"} {continue}
		if {$firstword=="function"} {
			if {$ispartoffunction} {
				puts "Dumping $filename"
				puts "[join $function \n]"
				set ispartoffunction 0
				set file [open $filename.php w]
				puts $file [join $function \n]
				puts $file {?>}
				close $file
			}
			set function {}
			lappend function {<?php}
			lappend function $i
			set filename [lindex [lindex [split $i (] 0] end]
			set ispartoffunction 1
		} elseif {$ispartoffunction} {
                	lappend function $i
		}
}
