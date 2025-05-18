import { fetchJson } from './fetchJson';

export function apiListArticles() {
  return fetchJson({ url: '/api/articles' }).request;
}
export function apiArticle(id) {
  return fetchJson({
    url: `/api/articles/${id}`,
    method: 'GET',
  }).request;
}
