import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map'
import { AppGlobals } from '../shared/app.global';

@Injectable()
export class AuthenticationService {

  constructor(private http: HttpClient, private _global: AppGlobals) { }

  login(username: string, password: string) {
    return this.http.post<any>('/api/authenticate', { username: username, password: password })
        .map(user => {
            // login successful if there's a jwt token in the response
            if (user && user.token) {
                // store user details and jwt token in local storage to keep user logged in between page refreshes
                localStorage.setItem('loggedUser', JSON.stringify(user));
            }

            return user;
        });
}

logout() {
    // remove user from local storage to log user out
    localStorage.removeItem('loggedUser');
}


}
