// import { UsersActions } from './user.actions';
// import { User } from '../users-list.component';
// import { createReducer, on } from '@ngrx/store';

// const initialState: { users: User[] } = {
//   users: [],
// };

// export const userReducer = createReducer(
//   initialState,
//   on(UsersActions.set, (state, payload) => ({
//     ...state,
//     users: payload.users,
//   })),
//   on(UsersActions.edit, (state, payload) => ({
//     ...state,
//     users: state.users.map((user) => (user.id === user.id ? user : user)),
//   })),
//   on(UsersActions.create, (state, payload) => ({
//     ...state,
//     users: [...state.users, payload.user],
//   })),
//   on(UsersActions.delete, (state, payload) => ({
//     ...state,
//     users: state.users.filter((user) => user.id !== payload.id),
//   }))
// );
