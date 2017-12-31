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
 
  constructor(private Auth: AuthService,private router: Router) { }

  ngOnInit() {
  }

  login() {
    this.loading = true;
    console.log(this.user.username);
    console.log(this.user.password);
    var username = this.user.username;
    var password = this.user.password;
    var userData ={username:username, password:password};
    this.Auth.login(userData)
        .subscribe(
            data => {
                console.log(data);
                
                 this.router.navigate(['/app/Home']);
            },
            error => {
                console.log(error);
                this.loading = false;
            });
}


}
