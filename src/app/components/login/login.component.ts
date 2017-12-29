import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from '../../services/authentication.service'

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  user: any = {};
  loading = false;
 
  constructor(private Auth: AuthenticationService) { }

  ngOnInit() {
  }


  login() {
    this.loading = true;
    console.log(this.user.username);
    console.log(this.user.password);
   
     var username = this.user.username;
     var password = this.user.password;

     //var userData = JSON.stringify({type:"user", username:username, password:password});
     var userData ={username:username, password:password};

    this.Auth.login(userData)
        .subscribe(
            data => {
                console.log(data);
            },
            error => {
                console.log(error);
                this.loading = false;
            });
}


}
