import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
import { Todo } from './todos-list/todos-list.component';

@Injectable({ providedIn: 'root' })
 
export class TodosService {
  TodosSubject$ = new BehaviorSubject <Todo[]>([]);

  setUser(users: Todo[]) {
    this.TodosSubject$.next(users);
  }

  editUser(editedUser: Todo) {
    this.TodosSubject$.next(
      this.TodosSubject$.value.map(
        user => {
        if (user.id === editedUser.id) {
          return editedUser;
        } else {
          return user;
        }
      })
    );
  }

   createTodo(user: Todo) {
      const existingUser = this.TodosSubject$.value.find(
        (currentElement) => currentElement.userId === user.userId
      );
  
      if (existingUser !== undefined) {
        alert('ТАКОЙ EMAIL УЖЕ ЗАРЕГИСТРИРОВАН');
      } else {
        this.TodosSubject$.next([...this.TodosSubject$.value, user]);
        alert('НОВЫЙ ПОЛЬЗАВАТЕЛЬ УСПЕШНО ДОБАВЛЕН');
      }
    }


 

  deleteUser(id: number) {
    this.TodosSubject$.next(
      this.TodosSubject$.value.filter((item) => {
        if (id === item.id) {
          return false;
        } else {
          return true;
        }
      })
    );

  }
}

 // createTodo(todo: Todo) {
  //   this.TodosSubject$.next([...this.TodosSubject$.value, todo]);
  // }