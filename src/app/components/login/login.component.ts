import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../services/index'
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  user: any = {};
  loading = false;
  scode: any = {};
  fyear: any = {};

 message: string;
  constructor(private Auth: AuthService,private router: Router) { }

  ngOnInit() {
  }

  login() {
    this.loading = true;

    var username = this.user.username;
    var password = this.user.password;
    var scode = this.user.scode;
    var fyear = this.user.fyear;
    var userData ={username:username, password:password,scode:scode,fyear:fyear};
    this.Auth.login(userData)
        .subscribe(
            data => {
                console.log(data);
                if(data==true){
                    this.router.navigate(['/app/Home']);
                }else{
                    this.message = "Wrong login credentials";
                }
                 
            },
            error => {
                console.log(error);
                this.loading = false;
            });
}


}
