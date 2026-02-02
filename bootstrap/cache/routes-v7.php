<?php

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/up' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PVXJ8QM23DGHyGFg',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/debug-test-1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::U2wyG4Fe4MDUm5uW',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/debug-test-2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ne7irsJZirl0fU71',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/debug-test-3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6fam3ehAfb67yXt1',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.home',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'profile.edit',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'profile.update',
          ),
          1 => NULL,
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'profile.destroy',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/2fa/enable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => '2fa.enable',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => '2fa.activate',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/2fa/generate-secret' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => '2fa.generate',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/2fa/disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => '2fa.disable',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/2fa/backup-codes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => '2fa.backup-codes',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/2fa/regenerate-backup-codes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => '2fa.regenerate-backup-codes',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/2fa/verify' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => '2fa.verify',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => '2fa.verify.post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cloudinary-test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0vVF3qBSg7wOvcCG',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/env-test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Fss7KQKyiSgL9HZr',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/fix-images' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::K5zmtUfo8pJGTlzm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wMrFPClCAUQhAknK',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::U6OSd0bpeRkWWT3e',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/forgot-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.request',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'password.email',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reset-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/verify-email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verification.notice',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/email/verification-notification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verification.send',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/confirm-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ze3CQR5HBgg2cHdS',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/explorer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.explorer',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/regions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.regions',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/apropos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.apropos',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/connexion' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.connexion',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'front.connexion.post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/inscription' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.inscription',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'front.inscription.post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/contributions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.contributions',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/likes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.likes',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.settings',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/settings/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.settings.profile.update',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/settings/password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.settings.password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/settings/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.settings.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard/contribuer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.contribuer',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard.contribuer.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/boutique' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'boutique.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/boutique/choisir' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'boutique.process.choix',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'boutique.choisir',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/boutique/paiement' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'boutique.paiement',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/boutique/paiement/process' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'boutique.process.paiement',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/boutique/success' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'boutique.success',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/boutique/echec' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'boutique.echec',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/boutique/annuler' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'boutique.annuler',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/fedapay/process' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'fedapay.process',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/fedapay/callback' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'fedapay.callback',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/fedapay/webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'fedapay.webhook',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/deconnexion' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'deconnexion',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/tableaudebord' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.tableaudebord',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/contenus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.contenus.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.contenus.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/contenus/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.contenus.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/users/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/roles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.roles.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.roles.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/roles/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.roles.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/commentaires' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.commentaires.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.commentaires.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/commentaires/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.commentaires.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/langues' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.langues.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.langues.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/langues/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.langues.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/medias' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.medias.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.medias.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/medias/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.medias.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/regions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.regions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.regions.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/regions/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.regions.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/parler' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.parler.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.parler.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/parler/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.parler.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/typecontenus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.typecontenus.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.typecontenus.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/typecontenus/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.typecontenus.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/moderateur' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.moderateur.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.profile.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/profile/edit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.profile.edit',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/profile/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.profile.update',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/profile/change-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.profile.change-password',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.profile.change-password.post',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.settings',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings/general' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.settings.general.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings/email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.settings.email.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings/security' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.settings.security.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/maintenance/enable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.maintenance.enable',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/maintenance/disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.maintenance.disable',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/cache/clear' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cache.clear',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/cache/config' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cache.config',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/re(?|set\\-password/([^/]++)(*:35)|gion/([^/]++)(*:55))|/verify\\-email/([^/]++)/([^/]++)(*:95)|/co(?|ntenu/(?|([0-9]+)(*:125)|([0-9]+)/preview\\-etendu(*:157))|mment/([0-9]+)(?|(*:183)))|/boutique/article/([^/]++)/acheter(*:227)|/f(?|edapay/check/([^/]++)(*:261)|avorite/([0-9]+)/toggle(*:292)|ollow/([0-9]+)/toggle(*:321))|/like/([0-9]+)/toggle(*:351)|/admin/(?|co(?|ntenus/([^/]++)(?|(*:392)|/(?|edit(*:408)|valider(*:423)|rejeter(*:438))|(*:447))|mmentaires/([^/]++)(?|(*:478)|/edit(*:491)|(*:499)))|users/([^/]++)(?|(*:526)|/(?|edit(*:542)|p(?|hoto(*:558)|rofile(*:572))|remove\\-photo(*:594)|activer(*:609)|desactiver(*:627))|(*:636))|r(?|oles/([^/]++)(?|(*:665)|/edit(*:678)|(*:686))|egions/([^/]++)(?|(*:713)|/edit(*:726)|(*:734)))|langues/([^/]++)(?|(*:763)|/edit(*:776)|(*:784))|m(?|edias/([^/]++)(?|(*:814)|/edit(*:827)|(*:835))|oderateur/([^/]++)(?|(*:865)|/(?|valider(*:884)|rejeter(*:899))))|parler/([^/]++)(?|(*:928)|/edit(*:941)|(*:949))|typecontenus/([^/]++)(?|(*:982)|/edit(*:995)|(*:1003)))|/storage/(.*)(*:1027)|/(.*)(*:1041))/?$}sDu',
    ),
    3 => 
    array (
      35 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      55 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.region',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      95 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verification.verify',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'hash',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      125 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.contenu',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      157 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'front.contenu.preview',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      183 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'comment.add',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'comment.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      227 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'boutique.article.acheter',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      261 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'fedapay.check.status',
          ),
          1 => 
          array (
            0 => 'reference',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      292 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'favorite.toggle',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      321 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'follow.toggle',
          ),
          1 => 
          array (
            0 => 'authorId',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      351 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'like.toggle',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      392 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.contenus.show',
          ),
          1 => 
          array (
            0 => 'contenu',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      408 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.contenus.edit',
          ),
          1 => 
          array (
            0 => 'contenu',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      423 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.contenus.valider',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      438 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.contenus.rejeter',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      447 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.contenus.update',
          ),
          1 => 
          array (
            0 => 'contenu',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.contenus.destroy',
          ),
          1 => 
          array (
            0 => 'contenu',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      478 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.commentaires.show',
          ),
          1 => 
          array (
            0 => 'commentaire',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      491 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.commentaires.edit',
          ),
          1 => 
          array (
            0 => 'commentaire',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      499 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.commentaires.update',
          ),
          1 => 
          array (
            0 => 'commentaire',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.commentaires.destroy',
          ),
          1 => 
          array (
            0 => 'commentaire',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      526 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.show',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      542 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.edit',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      558 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.updatePhoto',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      572 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.profile',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      594 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.removePhoto',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      609 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.activer',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      627 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.desactiver',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      636 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.update',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.destroy',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      665 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.roles.show',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      678 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.roles.edit',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      686 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.roles.update',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.roles.destroy',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      713 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.regions.show',
          ),
          1 => 
          array (
            0 => 'region',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      726 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.regions.edit',
          ),
          1 => 
          array (
            0 => 'region',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      734 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.regions.update',
          ),
          1 => 
          array (
            0 => 'region',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.regions.destroy',
          ),
          1 => 
          array (
            0 => 'region',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      763 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.langues.show',
          ),
          1 => 
          array (
            0 => 'langue',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      776 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.langues.edit',
          ),
          1 => 
          array (
            0 => 'langue',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      784 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.langues.update',
          ),
          1 => 
          array (
            0 => 'langue',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.langues.destroy',
          ),
          1 => 
          array (
            0 => 'langue',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      814 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.medias.show',
          ),
          1 => 
          array (
            0 => 'media',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      827 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.medias.edit',
          ),
          1 => 
          array (
            0 => 'media',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      835 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.medias.update',
          ),
          1 => 
          array (
            0 => 'media',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.medias.destroy',
          ),
          1 => 
          array (
            0 => 'media',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      865 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.moderateur.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      884 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.moderateur.valider',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      899 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.moderateur.rejeter',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      928 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.parler.show',
          ),
          1 => 
          array (
            0 => 'parler',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      941 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.parler.edit',
          ),
          1 => 
          array (
            0 => 'parler',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      949 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.parler.update',
          ),
          1 => 
          array (
            0 => 'parler',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.parler.destroy',
          ),
          1 => 
          array (
            0 => 'parler',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      982 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.typecontenus.show',
          ),
          1 => 
          array (
            0 => 'typecontenu',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      995 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.typecontenus.edit',
          ),
          1 => 
          array (
            0 => 'typecontenu',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1003 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.typecontenus.update',
          ),
          1 => 
          array (
            0 => 'typecontenu',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.typecontenus.destroy',
          ),
          1 => 
          array (
            0 => 'typecontenu',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1027 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'storage.local',
          ),
          1 => 
          array (
            0 => 'path',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1041 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2S4NOa2EdzpFkZTO',
          ),
          1 => 
          array (
            0 => 'fallbackPlaceholder',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'generated::PVXJ8QM23DGHyGFg' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'up',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:843:"function () {
                    $exception = null;

                    try {
                        \\Illuminate\\Support\\Facades\\Event::dispatch(new \\Illuminate\\Foundation\\Events\\DiagnosingHealth);
                    } catch (\\Throwable $e) {
                        if (app()->hasDebugModeEnabled()) {
                            throw $e;
                        }

                        report($e);

                        $exception = $e->getMessage();
                    }

                    return response(\\Illuminate\\Support\\Facades\\View::file(\'C:\\\\wamp64\\\\www\\\\culture\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Foundation\\\\Configuration\'.\'/../resources/health-up.blade.php\', [
                        \'exception\' => $exception,
                    ]), status: $exception ? 500 : 200);
                }";s:5:"scope";s:54:"Illuminate\\Foundation\\Configuration\\ApplicationBuilder";s:4:"this";N;s:4:"self";s:32:"00000000000009cb0000000000000000";}}',
        'as' => 'generated::PVXJ8QM23DGHyGFg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::U2wyG4Fe4MDUm5uW' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'debug-test-1',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:193:"function() {
    return \\response()->json([
        \'status\' => \'ok\',
        \'time\' => \\now(),
        \'session_id\' => \\session()->getId(),
        \'app_env\' => \\app()->environment()
    ]);
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000009ec0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::U2wyG4Fe4MDUm5uW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ne7irsJZirl0fU71' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'debug-test-2',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:54:"function() {
    return "Hello World - Simple HTML";
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000a820000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Ne7irsJZirl0fU71',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6fam3ehAfb67yXt1' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'debug-test-3',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:225:"function() {
    try {
        $test = \\App\\Helpers\\CloudinaryHelper::get(\'test.jpg\');
        return "CloudinaryHelper: OK";
    } catch (\\Exception $e) {
        return "CloudinaryHelper ERROR: " . $e->getMessage();
    }
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000099c0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::6fam3ehAfb67yXt1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\FrontController@index',
        'controller' => 'App\\Http\\Controllers\\FrontController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'front.home',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\DashboardController@index',
        'controller' => 'App\\Http\\Controllers\\DashboardController@index',
        'as' => 'dashboard.index',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'profile.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ProfileController@edit',
        'controller' => 'App\\Http\\Controllers\\ProfileController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'profile.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'profile.update' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ProfileController@update',
        'controller' => 'App\\Http\\Controllers\\ProfileController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'profile.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'profile.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ProfileController@destroy',
        'controller' => 'App\\Http\\Controllers\\ProfileController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'profile.destroy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    '2fa.enable' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '2fa/enable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TwoFactorController@showEnableForm',
        'controller' => 'App\\Http\\Controllers\\TwoFactorController@showEnableForm',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => '2fa.enable',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    '2fa.generate' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '2fa/generate-secret',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TwoFactorController@generateSecret',
        'controller' => 'App\\Http\\Controllers\\TwoFactorController@generateSecret',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => '2fa.generate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    '2fa.activate' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '2fa/enable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TwoFactorController@enable',
        'controller' => 'App\\Http\\Controllers\\TwoFactorController@enable',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => '2fa.activate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    '2fa.disable' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '2fa/disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TwoFactorController@disable',
        'controller' => 'App\\Http\\Controllers\\TwoFactorController@disable',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => '2fa.disable',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    '2fa.backup-codes' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '2fa/backup-codes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TwoFactorController@showBackupCodes',
        'controller' => 'App\\Http\\Controllers\\TwoFactorController@showBackupCodes',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => '2fa.backup-codes',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    '2fa.regenerate-backup-codes' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '2fa/regenerate-backup-codes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TwoFactorController@regenerateBackupCodes',
        'controller' => 'App\\Http\\Controllers\\TwoFactorController@regenerateBackupCodes',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => '2fa.regenerate-backup-codes',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    '2fa.verify' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '2fa/verify',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TwoFactorController@showVerifyForm',
        'controller' => 'App\\Http\\Controllers\\TwoFactorController@showVerifyForm',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => '2fa.verify',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    '2fa.verify.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '2fa/verify',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TwoFactorController@verify',
        'controller' => 'App\\Http\\Controllers\\TwoFactorController@verify',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => '2fa.verify.post',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0vVF3qBSg7wOvcCG' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cloudinary-test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:2092:"function() {
    echo "<h1>Test Cloudinary Configuration</h1>";
    echo "<style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .success { color: green; }
        .error { color: red; }
        .warning { color: orange; }
        .box { border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 5px; }
        img { max-width: 300px; border: 1px solid #ccc; margin: 10px 0; }
    </style>";

    // Test 1: Configuration
    echo "<div class=\'box\'>";
    echo "<h2>1. Configuration Cloudinary</h2>";

    $cloudName = \\config(\'cloudinary.cloud_name\');
    $cloudinaryUrl = \\env(\'CLOUDINARY_URL\');

    echo "<p>Cloud Name: <strong>" . ($cloudName ?: \'<span class="error">❌ NON CONFIGURÉ</span>\') . "</strong></p>";
    echo "<p>CLOUDINARY_URL dans .env: <strong>" . ($cloudinaryUrl ? \'<span class="success">✅ CONFIGURÉ</span>\' : \'<span class="error">❌ NON CONFIGURÉ</span>\') . "</strong></p>";

    if ($cloudinaryUrl) {
        $maskedUrl = \\preg_replace(\'/cloudinary:\\/\\/[^:]+:[^@]+@/\', \'cloudinary://***:***@\', $cloudinaryUrl);
        echo "<p>URL masquée: <code>$maskedUrl</code></p>";
    }
    echo "</div>";

    // Test 2: Images statiques
    echo "<div class=\'box\'>";
    echo "<h2>2. Test des images statiques</h2>";

    $testImages = [
        \'discoverbenin.jpg\',
        \'fresque.jpg\',
        \'routeesclave.webp\',
        \'beninwest.jpg\',
        \'mosqueeporto.jpeg\',
        \'royaumeabo.webp\',
        \'independancegraph.jpg\',
        \'ancientemps.jpg\',
        \'renaissance.webp\',
        \'contemporain.webp\',
        \'collage.png\',
        \'mamaafrica.jpg\'
    ];

    foreach ($testImages as $image) {
        $url = \\App\\Helpers\\CloudinaryHelper::static($image);
        echo "<p><strong>$image:</strong> ";
        if (\\strpos($url, \'res.cloudinary.com\') !== false) {
            echo "<span class=\'success\'>✅ Cloudinary</span>";
        } else {
            echo "<span class=\'error\'>❌ Erreur</span>";
        }
        echo "</p>";
    }
    echo "</div>";

    return "<p><a href=\'/\'>Retour à l\'accueil</a></p>";
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000a070000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::0vVF3qBSg7wOvcCG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Fss7KQKyiSgL9HZr' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'env-test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:206:"function() {
    echo "<h1>Test Environnement</h1>";
    echo "<p>APP_ENV: " . \\env(\'APP_ENV\') . "</p>";
    echo "<p>APP_DEBUG: " . \\env(\'APP_DEBUG\') . "</p>";
    return "<p><a href=\'/\'>Retour</a></p>";
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000a840000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Fss7KQKyiSgL9HZr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::K5zmtUfo8pJGTlzm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/fix-images',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:1034:"function() {
    if (\\request()->get(\'token\') !== \'benin2024\') {
        \\abort(403, \'Accès non autorisé\');
    }

    $images = [
        \'https://res.cloudinary.com/drzud4wye/image/upload/v1765979252/discoverbenin_vq9mik.jpg\',
        \'https://res.cloudinary.com/drzud4wye/image/upload/v1765979182/fresque_s4pcmz.jpg\',
        \'https://res.cloudinary.com/drzud4wye/image/upload/v1765979213/routeesclave_n5fo3i.webp\',
        \'https://res.cloudinary.com/drzud4wye/image/upload/v1765979237/beninwest_rj3d0o.jpg\',
        \'https://res.cloudinary.com/drzud4wye/image/upload/v1765979195/mosqueeporto_hdaiki.jpg\',
    ];

    $medias = \\App\\Models\\Media::all();
    $updated = 0;

    foreach ($medias as $index => $media) {
        $newUrl = $images[$index % \\count($images)];
        $media->update([
            \'chemin\' => $newUrl,
            \'cloudinary_url\' => $newUrl,
        ]);
        $updated++;
    }

    return \\response()->json([
        \'success\' => true,
        \'message\' => "$updated médias mis à jour",
    ]);
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000009a60000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::K5zmtUfo8pJGTlzm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisteredUserController@create',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisteredUserController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'register',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wMrFPClCAUQhAknK' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisteredUserController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisteredUserController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::wMrFPClCAUQhAknK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@create',
        'controller' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::U6OSd0bpeRkWWT3e' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::U6OSd0bpeRkWWT3e',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.request' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'forgot-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\PasswordResetLinkController@create',
        'controller' => 'App\\Http\\Controllers\\Auth\\PasswordResetLinkController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.request',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.email' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'forgot-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\PasswordResetLinkController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\PasswordResetLinkController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.email',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reset-password/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\NewPasswordController@create',
        'controller' => 'App\\Http\\Controllers\\Auth\\NewPasswordController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'reset-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\NewPasswordController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\NewPasswordController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'verification.notice' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'verify-email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\EmailVerificationPromptController@__invoke',
        'controller' => 'App\\Http\\Controllers\\Auth\\EmailVerificationPromptController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'verification.notice',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'verification.verify' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'verify-email/{id}/{hash}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'signed',
          3 => 'throttle:6,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\VerifyEmailController@__invoke',
        'controller' => 'App\\Http\\Controllers\\Auth\\VerifyEmailController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'verification.verify',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'verification.send' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'email/verification-notification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'throttle:6,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\EmailVerificationNotificationController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\EmailVerificationNotificationController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'verification.send',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'confirm-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmablePasswordController@show',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmablePasswordController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ze3CQR5HBgg2cHdS' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'confirm-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmablePasswordController@store',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmablePasswordController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Ze3CQR5HBgg2cHdS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\PasswordController@update',
        'controller' => 'App\\Http\\Controllers\\Auth\\PasswordController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@destroy',
        'controller' => 'App\\Http\\Controllers\\Auth\\AuthenticatedSessionController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.explorer' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'explorer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\FrontController@explorer',
        'controller' => 'App\\Http\\Controllers\\FrontController@explorer',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'front.explorer',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.regions' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'regions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\FrontController@regions',
        'controller' => 'App\\Http\\Controllers\\FrontController@regions',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'front.regions',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.region' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'region/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\FrontController@region',
        'controller' => 'App\\Http\\Controllers\\FrontController@region',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'front.region',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.apropos' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'apropos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\FrontController@apropos',
        'controller' => 'App\\Http\\Controllers\\FrontController@apropos',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'front.apropos',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.contenu' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'contenu/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\FrontController@contenu',
        'controller' => 'App\\Http\\Controllers\\FrontController@contenu',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'front.contenu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'id' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.connexion' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'connexion',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\FrontController@connexion',
        'controller' => 'App\\Http\\Controllers\\FrontController@connexion',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'front.connexion',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.connexion.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'connexion',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\FrontController@connexionPost',
        'controller' => 'App\\Http\\Controllers\\FrontController@connexionPost',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'front.connexion.post',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.inscription' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'inscription',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\FrontController@inscription',
        'controller' => 'App\\Http\\Controllers\\FrontController@inscription',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'front.inscription',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.inscription.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'inscription',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'App\\Http\\Controllers\\FrontController@inscriptionPost',
        'controller' => 'App\\Http\\Controllers\\FrontController@inscriptionPost',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'front.inscription.post',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.contributions' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/contributions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\DashboardController@contributions',
        'controller' => 'App\\Http\\Controllers\\DashboardController@contributions',
        'as' => 'dashboard.contributions',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.likes' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/likes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\DashboardController@likes',
        'controller' => 'App\\Http\\Controllers\\DashboardController@likes',
        'as' => 'dashboard.likes',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.settings' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SettingsController@index',
        'controller' => 'App\\Http\\Controllers\\SettingsController@index',
        'as' => 'dashboard.settings',
        'namespace' => NULL,
        'prefix' => 'dashboard/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.settings.profile.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'dashboard/settings/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SettingsController@updateProfile',
        'controller' => 'App\\Http\\Controllers\\SettingsController@updateProfile',
        'as' => 'dashboard.settings.profile.update',
        'namespace' => NULL,
        'prefix' => 'dashboard/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.settings.password.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'dashboard/settings/password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SettingsController@updatePassword',
        'controller' => 'App\\Http\\Controllers\\SettingsController@updatePassword',
        'as' => 'dashboard.settings.password.update',
        'namespace' => NULL,
        'prefix' => 'dashboard/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.settings.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'dashboard/settings/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SettingsController@deleteAccount',
        'controller' => 'App\\Http\\Controllers\\SettingsController@deleteAccount',
        'as' => 'dashboard.settings.delete',
        'namespace' => NULL,
        'prefix' => 'dashboard/settings',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.contribuer' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard/contribuer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\DashboardController@contribuer',
        'controller' => 'App\\Http\\Controllers\\DashboardController@contribuer',
        'as' => 'dashboard.contribuer',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard.contribuer.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'dashboard/contribuer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\DashboardController@storeContribution',
        'controller' => 'App\\Http\\Controllers\\DashboardController@storeContribution',
        'as' => 'dashboard.contribuer.store',
        'namespace' => NULL,
        'prefix' => '/dashboard',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'boutique.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'boutique',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PaiementController@index',
        'controller' => 'App\\Http\\Controllers\\PaiementController@index',
        'as' => 'boutique.index',
        'namespace' => NULL,
        'prefix' => '/boutique',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'boutique.process.choix' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'boutique/choisir',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PaiementController@processChoix',
        'controller' => 'App\\Http\\Controllers\\PaiementController@processChoix',
        'as' => 'boutique.process.choix',
        'namespace' => NULL,
        'prefix' => '/boutique',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'boutique.choisir' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'boutique/choisir',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PaiementController@choisir',
        'controller' => 'App\\Http\\Controllers\\PaiementController@choisir',
        'as' => 'boutique.choisir',
        'namespace' => NULL,
        'prefix' => '/boutique',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'boutique.paiement' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'boutique/paiement',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PaiementController@paiement',
        'controller' => 'App\\Http\\Controllers\\PaiementController@paiement',
        'as' => 'boutique.paiement',
        'namespace' => NULL,
        'prefix' => '/boutique',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'boutique.process.paiement' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'boutique/paiement/process',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PaiementController@processPaiement',
        'controller' => 'App\\Http\\Controllers\\PaiementController@processPaiement',
        'as' => 'boutique.process.paiement',
        'namespace' => NULL,
        'prefix' => '/boutique',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'boutique.success' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'boutique/success',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PaiementController@success',
        'controller' => 'App\\Http\\Controllers\\PaiementController@success',
        'as' => 'boutique.success',
        'namespace' => NULL,
        'prefix' => '/boutique',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'boutique.echec' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'boutique/echec',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PaiementController@echec',
        'controller' => 'App\\Http\\Controllers\\PaiementController@echec',
        'as' => 'boutique.echec',
        'namespace' => NULL,
        'prefix' => '/boutique',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'boutique.annuler' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'boutique/annuler',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PaiementController@annuler',
        'controller' => 'App\\Http\\Controllers\\PaiementController@annuler',
        'as' => 'boutique.annuler',
        'namespace' => NULL,
        'prefix' => '/boutique',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'boutique.article.acheter' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'boutique/article/{id}/acheter',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\PaiementController@acheterArticle',
        'controller' => 'App\\Http\\Controllers\\PaiementController@acheterArticle',
        'as' => 'boutique.article.acheter',
        'namespace' => NULL,
        'prefix' => '/boutique',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'fedapay.process' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'fedapay/process',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\FedapayController@process',
        'controller' => 'App\\Http\\Controllers\\FedapayController@process',
        'as' => 'fedapay.process',
        'namespace' => NULL,
        'prefix' => '/fedapay',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'fedapay.callback' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'fedapay/callback',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PaiementController@fedapayCallback',
        'controller' => 'App\\Http\\Controllers\\PaiementController@fedapayCallback',
        'as' => 'fedapay.callback',
        'namespace' => NULL,
        'prefix' => '/fedapay',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'fedapay.webhook' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'fedapay/webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\FedapayController@webhook',
        'controller' => 'App\\Http\\Controllers\\FedapayController@webhook',
        'as' => 'fedapay.webhook',
        'namespace' => NULL,
        'prefix' => '/fedapay',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'fedapay.check.status' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'fedapay/check/{reference}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\FedapayController@checkStatus',
        'controller' => 'App\\Http\\Controllers\\FedapayController@checkStatus',
        'as' => 'fedapay.check.status',
        'namespace' => NULL,
        'prefix' => '/fedapay',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'like.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'like/{id}/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\InteractionController@toggleLike',
        'controller' => 'App\\Http\\Controllers\\InteractionController@toggleLike',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'like.toggle',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'id' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'favorite.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'favorite/{id}/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\InteractionController@toggleFavorite',
        'controller' => 'App\\Http\\Controllers\\InteractionController@toggleFavorite',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'favorite.toggle',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'id' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'follow.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'follow/{authorId}/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\InteractionController@toggleFollow',
        'controller' => 'App\\Http\\Controllers\\InteractionController@toggleFollow',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'follow.toggle',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'authorId' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'comment.add' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'comment/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\InteractionController@addComment',
        'controller' => 'App\\Http\\Controllers\\InteractionController@addComment',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'comment.add',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'id' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'comment.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'comment/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\InteractionController@deleteComment',
        'controller' => 'App\\Http\\Controllers\\InteractionController@deleteComment',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'comment.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'id' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'front.contenu.preview' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'contenu/{id}/preview-etendu',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\FrontController@getExtendedPreview',
        'controller' => 'App\\Http\\Controllers\\FrontController@getExtendedPreview',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'front.contenu.preview',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'id' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'deconnexion' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'deconnexion',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:224:"function () {
    \\Illuminate\\Support\\Facades\\Auth::logout();
    \\request()->session()->invalidate();
    \\request()->session()->regenerateToken();
    return \\redirect(\'/\')->with(\'success\', \'Déconnecté avec succès.\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000a010000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'deconnexion',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2S4NOa2EdzpFkZTO' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{fallbackPlaceholder}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:96:"function () {
    return \\redirect()->route(\'front.home\')->with(\'error\', \'Page non trouvée\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000009a10000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::2S4NOa2EdzpFkZTO',
      ),
      'fallback' => true,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'fallbackPlaceholder' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.tableaudebord' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/tableaudebord',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@index',
        'controller' => 'App\\Http\\Controllers\\HomeController@index',
        'as' => 'admin.tableaudebord',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.contenus.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/contenus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur,Contributeur',
        ),
        'as' => 'admin.contenus.index',
        'uses' => 'App\\Http\\Controllers\\ContenuController@index',
        'controller' => 'App\\Http\\Controllers\\ContenuController@index',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.contenus.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/contenus/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur,Contributeur',
        ),
        'as' => 'admin.contenus.create',
        'uses' => 'App\\Http\\Controllers\\ContenuController@create',
        'controller' => 'App\\Http\\Controllers\\ContenuController@create',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.contenus.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/contenus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur,Contributeur',
        ),
        'as' => 'admin.contenus.store',
        'uses' => 'App\\Http\\Controllers\\ContenuController@store',
        'controller' => 'App\\Http\\Controllers\\ContenuController@store',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.contenus.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/contenus/{contenu}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur,Contributeur',
        ),
        'as' => 'admin.contenus.show',
        'uses' => 'App\\Http\\Controllers\\ContenuController@show',
        'controller' => 'App\\Http\\Controllers\\ContenuController@show',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.contenus.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/contenus/{contenu}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur,Contributeur',
        ),
        'as' => 'admin.contenus.edit',
        'uses' => 'App\\Http\\Controllers\\ContenuController@edit',
        'controller' => 'App\\Http\\Controllers\\ContenuController@edit',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.contenus.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/contenus/{contenu}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur,Contributeur',
        ),
        'as' => 'admin.contenus.update',
        'uses' => 'App\\Http\\Controllers\\ContenuController@update',
        'controller' => 'App\\Http\\Controllers\\ContenuController@update',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.contenus.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/contenus/{contenu}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur,Contributeur',
        ),
        'as' => 'admin.contenus.destroy',
        'uses' => 'App\\Http\\Controllers\\ContenuController@destroy',
        'controller' => 'App\\Http\\Controllers\\ContenuController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.contenus.valider' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/contenus/{id}/valider',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur,Contributeur',
        ),
        'uses' => 'App\\Http\\Controllers\\ContenuController@valider',
        'controller' => 'App\\Http\\Controllers\\ContenuController@valider',
        'as' => 'admin.contenus.valider',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.contenus.rejeter' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/contenus/{id}/rejeter',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur,Contributeur',
        ),
        'uses' => 'App\\Http\\Controllers\\ContenuController@rejeter',
        'controller' => 'App\\Http\\Controllers\\ContenuController@rejeter',
        'as' => 'admin.contenus.rejeter',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'as' => 'admin.users.index',
        'uses' => 'App\\Http\\Controllers\\UserController@index',
        'controller' => 'App\\Http\\Controllers\\UserController@index',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'as' => 'admin.users.create',
        'uses' => 'App\\Http\\Controllers\\UserController@create',
        'controller' => 'App\\Http\\Controllers\\UserController@create',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'as' => 'admin.users.store',
        'uses' => 'App\\Http\\Controllers\\UserController@store',
        'controller' => 'App\\Http\\Controllers\\UserController@store',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'as' => 'admin.users.show',
        'uses' => 'App\\Http\\Controllers\\UserController@show',
        'controller' => 'App\\Http\\Controllers\\UserController@show',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users/{user}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@edit',
        'controller' => 'App\\Http\\Controllers\\UserController@edit',
        'as' => 'admin.users.edit',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'as' => 'admin.users.update',
        'uses' => 'App\\Http\\Controllers\\UserController@update',
        'controller' => 'App\\Http\\Controllers\\UserController@update',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'as' => 'admin.users.destroy',
        'uses' => 'App\\Http\\Controllers\\UserController@destroy',
        'controller' => 'App\\Http\\Controllers\\UserController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.roles.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'as' => 'admin.roles.index',
        'uses' => 'App\\Http\\Controllers\\RoleController@index',
        'controller' => 'App\\Http\\Controllers\\RoleController@index',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.roles.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'as' => 'admin.roles.create',
        'uses' => 'App\\Http\\Controllers\\RoleController@create',
        'controller' => 'App\\Http\\Controllers\\RoleController@create',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.roles.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/roles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'as' => 'admin.roles.store',
        'uses' => 'App\\Http\\Controllers\\RoleController@store',
        'controller' => 'App\\Http\\Controllers\\RoleController@store',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.roles.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'as' => 'admin.roles.show',
        'uses' => 'App\\Http\\Controllers\\RoleController@show',
        'controller' => 'App\\Http\\Controllers\\RoleController@show',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.roles.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles/{role}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'as' => 'admin.roles.edit',
        'uses' => 'App\\Http\\Controllers\\RoleController@edit',
        'controller' => 'App\\Http\\Controllers\\RoleController@edit',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.roles.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/roles/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'as' => 'admin.roles.update',
        'uses' => 'App\\Http\\Controllers\\RoleController@update',
        'controller' => 'App\\Http\\Controllers\\RoleController@update',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.roles.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/roles/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'as' => 'admin.roles.destroy',
        'uses' => 'App\\Http\\Controllers\\RoleController@destroy',
        'controller' => 'App\\Http\\Controllers\\RoleController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.updatePhoto' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/users/{id}/photo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@updatePhoto',
        'controller' => 'App\\Http\\Controllers\\UserController@updatePhoto',
        'as' => 'admin.users.updatePhoto',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.removePhoto' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/users/{user}/remove-photo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@removePhoto',
        'controller' => 'App\\Http\\Controllers\\UserController@removePhoto',
        'as' => 'admin.users.removePhoto',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.activer' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/users/{user}/activer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@activer',
        'controller' => 'App\\Http\\Controllers\\UserController@activer',
        'as' => 'admin.users.activer',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.desactiver' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/users/{user}/desactiver',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@desactiver',
        'controller' => 'App\\Http\\Controllers\\UserController@desactiver',
        'as' => 'admin.users.desactiver',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.commentaires.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/commentaires',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur',
        ),
        'as' => 'admin.commentaires.index',
        'uses' => 'App\\Http\\Controllers\\CommentaireController@index',
        'controller' => 'App\\Http\\Controllers\\CommentaireController@index',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.commentaires.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/commentaires/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur',
        ),
        'as' => 'admin.commentaires.create',
        'uses' => 'App\\Http\\Controllers\\CommentaireController@create',
        'controller' => 'App\\Http\\Controllers\\CommentaireController@create',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.commentaires.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/commentaires',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur',
        ),
        'as' => 'admin.commentaires.store',
        'uses' => 'App\\Http\\Controllers\\CommentaireController@store',
        'controller' => 'App\\Http\\Controllers\\CommentaireController@store',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.commentaires.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/commentaires/{commentaire}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur',
        ),
        'as' => 'admin.commentaires.show',
        'uses' => 'App\\Http\\Controllers\\CommentaireController@show',
        'controller' => 'App\\Http\\Controllers\\CommentaireController@show',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.commentaires.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/commentaires/{commentaire}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur',
        ),
        'as' => 'admin.commentaires.edit',
        'uses' => 'App\\Http\\Controllers\\CommentaireController@edit',
        'controller' => 'App\\Http\\Controllers\\CommentaireController@edit',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.commentaires.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/commentaires/{commentaire}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur',
        ),
        'as' => 'admin.commentaires.update',
        'uses' => 'App\\Http\\Controllers\\CommentaireController@update',
        'controller' => 'App\\Http\\Controllers\\CommentaireController@update',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.commentaires.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/commentaires/{commentaire}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur',
        ),
        'as' => 'admin.commentaires.destroy',
        'uses' => 'App\\Http\\Controllers\\CommentaireController@destroy',
        'controller' => 'App\\Http\\Controllers\\CommentaireController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.langues.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/langues',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.langues.index',
        'uses' => 'App\\Http\\Controllers\\LanguesController@index',
        'controller' => 'App\\Http\\Controllers\\LanguesController@index',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.langues.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/langues/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.langues.create',
        'uses' => 'App\\Http\\Controllers\\LanguesController@create',
        'controller' => 'App\\Http\\Controllers\\LanguesController@create',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.langues.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/langues',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.langues.store',
        'uses' => 'App\\Http\\Controllers\\LanguesController@store',
        'controller' => 'App\\Http\\Controllers\\LanguesController@store',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.langues.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/langues/{langue}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.langues.show',
        'uses' => 'App\\Http\\Controllers\\LanguesController@show',
        'controller' => 'App\\Http\\Controllers\\LanguesController@show',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.langues.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/langues/{langue}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.langues.edit',
        'uses' => 'App\\Http\\Controllers\\LanguesController@edit',
        'controller' => 'App\\Http\\Controllers\\LanguesController@edit',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.langues.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/langues/{langue}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.langues.update',
        'uses' => 'App\\Http\\Controllers\\LanguesController@update',
        'controller' => 'App\\Http\\Controllers\\LanguesController@update',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.langues.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/langues/{langue}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.langues.destroy',
        'uses' => 'App\\Http\\Controllers\\LanguesController@destroy',
        'controller' => 'App\\Http\\Controllers\\LanguesController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.medias.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/medias',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.medias.index',
        'uses' => 'App\\Http\\Controllers\\MediaController@index',
        'controller' => 'App\\Http\\Controllers\\MediaController@index',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.medias.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/medias/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.medias.create',
        'uses' => 'App\\Http\\Controllers\\MediaController@create',
        'controller' => 'App\\Http\\Controllers\\MediaController@create',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.medias.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/medias',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.medias.store',
        'uses' => 'App\\Http\\Controllers\\MediaController@store',
        'controller' => 'App\\Http\\Controllers\\MediaController@store',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.medias.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/medias/{media}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.medias.show',
        'uses' => 'App\\Http\\Controllers\\MediaController@show',
        'controller' => 'App\\Http\\Controllers\\MediaController@show',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.medias.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/medias/{media}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.medias.edit',
        'uses' => 'App\\Http\\Controllers\\MediaController@edit',
        'controller' => 'App\\Http\\Controllers\\MediaController@edit',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.medias.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/medias/{media}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.medias.update',
        'uses' => 'App\\Http\\Controllers\\MediaController@update',
        'controller' => 'App\\Http\\Controllers\\MediaController@update',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.medias.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/medias/{media}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.medias.destroy',
        'uses' => 'App\\Http\\Controllers\\MediaController@destroy',
        'controller' => 'App\\Http\\Controllers\\MediaController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.regions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/regions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.regions.index',
        'uses' => 'App\\Http\\Controllers\\RegionController@index',
        'controller' => 'App\\Http\\Controllers\\RegionController@index',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.regions.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/regions/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.regions.create',
        'uses' => 'App\\Http\\Controllers\\RegionController@create',
        'controller' => 'App\\Http\\Controllers\\RegionController@create',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.regions.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/regions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.regions.store',
        'uses' => 'App\\Http\\Controllers\\RegionController@store',
        'controller' => 'App\\Http\\Controllers\\RegionController@store',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.regions.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/regions/{region}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.regions.show',
        'uses' => 'App\\Http\\Controllers\\RegionController@show',
        'controller' => 'App\\Http\\Controllers\\RegionController@show',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.regions.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/regions/{region}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.regions.edit',
        'uses' => 'App\\Http\\Controllers\\RegionController@edit',
        'controller' => 'App\\Http\\Controllers\\RegionController@edit',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.regions.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/regions/{region}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.regions.update',
        'uses' => 'App\\Http\\Controllers\\RegionController@update',
        'controller' => 'App\\Http\\Controllers\\RegionController@update',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.regions.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/regions/{region}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.regions.destroy',
        'uses' => 'App\\Http\\Controllers\\RegionController@destroy',
        'controller' => 'App\\Http\\Controllers\\RegionController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.parler.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/parler',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.parler.index',
        'uses' => 'App\\Http\\Controllers\\ParlerController@index',
        'controller' => 'App\\Http\\Controllers\\ParlerController@index',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.parler.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/parler/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.parler.create',
        'uses' => 'App\\Http\\Controllers\\ParlerController@create',
        'controller' => 'App\\Http\\Controllers\\ParlerController@create',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.parler.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/parler',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.parler.store',
        'uses' => 'App\\Http\\Controllers\\ParlerController@store',
        'controller' => 'App\\Http\\Controllers\\ParlerController@store',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.parler.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/parler/{parler}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.parler.show',
        'uses' => 'App\\Http\\Controllers\\ParlerController@show',
        'controller' => 'App\\Http\\Controllers\\ParlerController@show',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.parler.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/parler/{parler}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.parler.edit',
        'uses' => 'App\\Http\\Controllers\\ParlerController@edit',
        'controller' => 'App\\Http\\Controllers\\ParlerController@edit',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.parler.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/parler/{parler}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.parler.update',
        'uses' => 'App\\Http\\Controllers\\ParlerController@update',
        'controller' => 'App\\Http\\Controllers\\ParlerController@update',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.parler.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/parler/{parler}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.parler.destroy',
        'uses' => 'App\\Http\\Controllers\\ParlerController@destroy',
        'controller' => 'App\\Http\\Controllers\\ParlerController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.typecontenus.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/typecontenus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.typecontenus.index',
        'uses' => 'App\\Http\\Controllers\\TypeContenuController@index',
        'controller' => 'App\\Http\\Controllers\\TypeContenuController@index',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.typecontenus.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/typecontenus/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.typecontenus.create',
        'uses' => 'App\\Http\\Controllers\\TypeContenuController@create',
        'controller' => 'App\\Http\\Controllers\\TypeContenuController@create',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.typecontenus.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/typecontenus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.typecontenus.store',
        'uses' => 'App\\Http\\Controllers\\TypeContenuController@store',
        'controller' => 'App\\Http\\Controllers\\TypeContenuController@store',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.typecontenus.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/typecontenus/{typecontenu}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.typecontenus.show',
        'uses' => 'App\\Http\\Controllers\\TypeContenuController@show',
        'controller' => 'App\\Http\\Controllers\\TypeContenuController@show',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.typecontenus.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/typecontenus/{typecontenu}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.typecontenus.edit',
        'uses' => 'App\\Http\\Controllers\\TypeContenuController@edit',
        'controller' => 'App\\Http\\Controllers\\TypeContenuController@edit',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.typecontenus.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/typecontenus/{typecontenu}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.typecontenus.update',
        'uses' => 'App\\Http\\Controllers\\TypeContenuController@update',
        'controller' => 'App\\Http\\Controllers\\TypeContenuController@update',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.typecontenus.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/typecontenus/{typecontenu}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Contributeur',
        ),
        'as' => 'admin.typecontenus.destroy',
        'uses' => 'App\\Http\\Controllers\\TypeContenuController@destroy',
        'controller' => 'App\\Http\\Controllers\\TypeContenuController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.moderateur.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/moderateur',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur',
        ),
        'uses' => 'App\\Http\\Controllers\\ModerationController@index',
        'controller' => 'App\\Http\\Controllers\\ModerationController@index',
        'as' => 'admin.moderateur.index',
        'namespace' => NULL,
        'prefix' => 'admin/moderateur',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.moderateur.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/moderateur/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur',
        ),
        'uses' => 'App\\Http\\Controllers\\ModerationController@show',
        'controller' => 'App\\Http\\Controllers\\ModerationController@show',
        'as' => 'admin.moderateur.show',
        'namespace' => NULL,
        'prefix' => 'admin/moderateur',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.moderateur.valider' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/moderateur/{id}/valider',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur',
        ),
        'uses' => 'App\\Http\\Controllers\\ModerationController@valider',
        'controller' => 'App\\Http\\Controllers\\ModerationController@valider',
        'as' => 'admin.moderateur.valider',
        'namespace' => NULL,
        'prefix' => 'admin/moderateur',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.moderateur.rejeter' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/moderateur/{id}/rejeter',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur,Modérateur',
        ),
        'uses' => 'App\\Http\\Controllers\\ModerationController@rejeter',
        'controller' => 'App\\Http\\Controllers\\ModerationController@rejeter',
        'as' => 'admin.moderateur.rejeter',
        'namespace' => NULL,
        'prefix' => 'admin/moderateur',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.profile.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@showProfile',
        'controller' => 'App\\Http\\Controllers\\UserController@showProfile',
        'as' => 'admin.profile.show',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.profile.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/profile/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@editProfile',
        'controller' => 'App\\Http\\Controllers\\UserController@editProfile',
        'as' => 'admin.profile.edit',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.profile.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/profile/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@updateProfile',
        'controller' => 'App\\Http\\Controllers\\UserController@updateProfile',
        'as' => 'admin.profile.update',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.profile' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users/{user}/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@showProfileDetails',
        'controller' => 'App\\Http\\Controllers\\UserController@showProfileDetails',
        'as' => 'admin.users.profile',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.profile.change-password' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/profile/change-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@showChangePasswordForm',
        'controller' => 'App\\Http\\Controllers\\UserController@showChangePasswordForm',
        'as' => 'admin.profile.change-password',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.profile.change-password.post' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/profile/change-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@changePassword',
        'controller' => 'App\\Http\\Controllers\\UserController@changePassword',
        'as' => 'admin.profile.change-password.post',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.settings' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'uses' => 'App\\Http\\Controllers\\SettingsAdminController@index',
        'controller' => 'App\\Http\\Controllers\\SettingsAdminController@index',
        'as' => 'admin.settings',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.settings.general.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/settings/general',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'uses' => 'App\\Http\\Controllers\\SettingsAdminController@updateGeneral',
        'controller' => 'App\\Http\\Controllers\\SettingsAdminController@updateGeneral',
        'as' => 'admin.settings.general.update',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.settings.email.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/settings/email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'uses' => 'App\\Http\\Controllers\\SettingsAdminController@updateEmail',
        'controller' => 'App\\Http\\Controllers\\SettingsAdminController@updateEmail',
        'as' => 'admin.settings.email.update',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.settings.security.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/settings/security',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'uses' => 'App\\Http\\Controllers\\SettingsAdminController@updateSecurity',
        'controller' => 'App\\Http\\Controllers\\SettingsAdminController@updateSecurity',
        'as' => 'admin.settings.security.update',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.maintenance.enable' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/maintenance/enable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:318:"function () {
        \\Illuminate\\Support\\Facades\\Artisan::call(\'down\', [
            \'--secret\' => \'maintenance-\' . \\time(),
            \'--retry\' => \'60\'
        ]);
        return \\redirect()->route(\'admin.settings\') // ICI on utilise admin.settings
            ->with(\'success\', \'Mode maintenance activé.\');
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000a7a0000000000000000";}}',
        'as' => 'admin.maintenance.enable',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.maintenance.disable' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/maintenance/disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:225:"function () {
        \\Illuminate\\Support\\Facades\\Artisan::call(\'up\');
        return \\redirect()->route(\'admin.settings\') // ICI on utilise admin.settings
            ->with(\'success\', \'Mode maintenance désactivé.\');
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000a7c0000000000000000";}}',
        'as' => 'admin.maintenance.disable',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cache.clear' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/cache/clear',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:230:"function () {
        \\Illuminate\\Support\\Facades\\Artisan::call(\'cache:clear\');
        return \\redirect()->route(\'admin.settings\') // ICI on utilise admin.settings
            ->with(\'success\', \'Cache vidé avec succès.\');
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000a7e0000000000000000";}}',
        'as' => 'admin.cache.clear',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cache.config' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/cache/config',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'role:Administrateur',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:234:"function () {
        \\Illuminate\\Support\\Facades\\Artisan::call(\'config:cache\');
        return \\redirect()->route(\'admin.settings\') // ICI on utilise admin.settings
            ->with(\'success\', \'Configuration mise en cache.\');
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000a800000000000000000";}}',
        'as' => 'admin.cache.config',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'storage.local' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'storage/{path}',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:3:{s:4:"disk";s:5:"local";s:6:"config";a:5:{s:6:"driver";s:5:"local";s:4:"root";s:41:"C:\\wamp64\\www\\culture\\storage\\app/private";s:5:"serve";b:1;s:5:"throw";b:0;s:6:"report";b:0;}s:12:"isProduction";b:0;}s:8:"function";s:329:"function (\\Illuminate\\Http\\Request $request, string $path) use ($disk, $config, $isProduction) {
                    return (new \\Illuminate\\Filesystem\\ServeFile(
                        $disk,
                        $config,
                        $isProduction
                    ))($request, $path);
                }";s:5:"scope";s:47:"Illuminate\\Filesystem\\FilesystemServiceProvider";s:4:"this";N;s:4:"self";s:32:"0000000000000a030000000000000000";}}',
        'as' => 'storage.local',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'path' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
