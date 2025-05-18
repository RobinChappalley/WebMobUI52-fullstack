import { fetchJson } from './fetchJson';

export function apiLogin(credentials) {
  return fetchJson({
    url: '/api/login',
    method: 'POST',
    data: credentials,
    skipAuth: true,
  }).request;
}
export function apiRegister(form) {
  return fetchJson({
    url: '/api/register',
    method: 'POST',
    data: form,
    skipAuth: true,
  }).request;
}
export function apiLogout() {
  return fetchJson({
    url: '/api/logout',
    method: 'POST',
  }).request;
}
