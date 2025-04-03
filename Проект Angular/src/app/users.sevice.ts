import { Injectable } from '@angular/core';
import { User } from './users-list/users-list.component';
import { BehaviorSubject } from 'rxjs';
// import { UserActions } from './users-list/store/user.actions';

@Injectable({ providedIn: 'root' })
export class UsersService {
  usersSubject = new BehaviorSubject<User[]>([]);
  users$ = this.usersSubject.asObservable();




//   setUser(users: User[]) {
//     this.Store.dispatch(UserActions.set({ users }));
//   }

//   editUser(editedUser: User) {
//     this.store.dispatch(UserActions.edit({ user: editedUser }));
//   }

//   createUser(user: User) {
//     this.store.dispatch(UserActions.create({ user: user }));
//   }

//   deleteUser(id: number) {
//     this.store.dispatch(UserActions.delet({ id }));
//   }
// }






  setUser(users: User[]) {
    this.usersSubject.next(users);
  }

  editUser(editedUser: User) {
    this.usersSubject.next(
      this.usersSubject.value.map((user) => {
        if (user.id === editedUser.id) {
          return editedUser;
        } else {
          return user;
        }
      })
    );
  }

  createUser(user: User) {
    const existingUser = this.usersSubject.value.find(
      (currentElement) => currentElement.email === user.email
    );

    if (existingUser !== undefined) {
      alert('ТАКОЙ EMAIL УЖЕ ЗАРЕГИСТРИРОВАН');
    } else {
      this.usersSubject.next([...this.usersSubject.value, user]);
      alert('НОВЫЙ ПОЛЬЗАВАТЕЛЬ УСПЕШНО ДОБАВЛЕН');
    }
  }

  deleteUser(id: number) {
    this.usersSubject.next(
      this.usersSubject.value.filter((item) => {
        if (id === item.id) {
          return false;
        } else {
          return true;
        }
      })
    );
  }
}
