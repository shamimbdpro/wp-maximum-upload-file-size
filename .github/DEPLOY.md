# Deploy EasyMedia to WordPress.org (GitHub Actions)

## One-time setup

1. Confirm you are a **committer** on [wp-maximum-upload-file-size](https://wordpress.org/plugins/wp-maximum-upload-file-size/).
2. Create a WordPress.org **application password**: [Profile → Application Passwords](https://profiles.wordpress.org/me/profile/edit/group/3/).
3. Add secrets on environment **`wordpress-org`** (exact names, case-sensitive):
   - **Settings → Environments → wordpress-org → Environment secrets → Add secret**
   - `SVN_USERNAME` — WordPress.org **username** (login slug, not email)
   - `SVN_PASSWORD` — [Application password](https://profiles.wordpress.org/me/profile/edit/group/3/) (spaces optional when pasting; use the generated password only)
   - (Optional) You can use **Repository secrets** instead; then remove `environment: wordpress-org` from the workflow.

### Troubleshooting “Set the SVN_USERNAME secret”

| Cause | Fix |
|--------|-----|
| Secrets not created | Add **Repository secrets** as above (not only Variables). |
| Wrong names | Must be `SVN_USERNAME` and `SVN_PASSWORD` — not `SVN_USER`, `WP_ORG_PASSWORD`, etc. |
| Secrets only under **Environments** | In `.github/workflows/deploy-wordpress-org.yml`, uncomment `environment: wordpress-org` (or your env name) on the `deploy` job and put the same two secrets on that environment. |
| Wrong repo / fork | Secrets must be on the repo that runs the workflow; forks do not inherit parent secrets. |
| Org secret | Organization secret must allow access to this repository. |

After fixing secrets, re-run: **Actions → Deploy to WordPress.org → Re-run all jobs**.

## Release workflow

1. Bump `Version` in `wp-maximum-upload-file-size.php`, `WMUFS_PLUGIN_VERSION`, and `Stable tag` + changelog in `readme.txt`.
2. Merge into **`master`** (or your main branch) as usual.
3. Push or merge the same code to the **`release`** branch:
   ```bash
   git checkout release
   git merge master
   git push origin release
   ```
4. Open **Actions → Deploy to WordPress.org** and confirm the run succeeded.

You can also run the workflow manually: **Actions → Deploy to WordPress.org → Run workflow**.

## Notes

- The deploy action creates/updates **SVN `trunk`** and copies it to **`tags/{version}`** using the plugin header version.
- If **`tags/{version}` already exists** on SVN, the 10up action **skips the commit** (no duplicate tag). Bump the version for a new public release.
- Plugin banners, icons, and screenshots live in [`.wordpress-org/`](../.wordpress-org/) (synced from WordPress.org). Edit there and deploy via the `release` branch; the action copies them to SVN `assets/` (not `trunk/`). See [plugin assets handbook](https://developer.wordpress.org/plugins/wordpress-org/plugin-assets/).
