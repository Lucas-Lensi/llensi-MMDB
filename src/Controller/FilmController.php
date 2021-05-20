<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Repository\ActorRepository;
use App\Repository\GenreRepository;
use App\Repository\StudioRepository;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ObjectManager;

use Doctrine\ORM\EntityManagerInterface;

class FilmController extends AbstractController
{
    /**
     * @Route("/film", name="film")
     */
    public function index(MovieRepository $movieRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $movies = $movieRepository->findAll();
        return $this->render('film/index.html.twig', [
            'controller_name' => 'FilmController',
            'movies' => $movies
        ]);
    }

    /**
     * @Route("/actor/{id}", name="actor")
     */
    public function filmsByActor(ActorRepository $actorRepository, $id): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $actor = $actorRepository->find($id);
        return $this->render('film/actor.html.twig', [
            'controller_name' => 'FilmController',
            'actor' => $actor
        ]);
    }

    /**
     * @Route("/genre/{id}", name="genre")
     */
    public function filmsByGenre(GenreRepository $genreRepository, $id): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $genre = $genreRepository->find($id);
        return $this->render('film/genre.html.twig', [
            'controller_name' => 'FilmController',
            'genre' => $genre
        ]);
    }

    /**
     * @Route("/studio/{id}", name="studio")
     */
    public function filmsByStudio(StudioRepository $studioRepository, $id): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $studio = $studioRepository->find($id);
        return $this->render('film/studio.html.twig', [
            'controller_name' => 'FilmController',
            'studio' => $studio
        ]);
    }

    /**
     * @Route("/watchList", name="watchList")
     */
    public function getWatchList(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $watchList = $this->getUser()->getWatchList();
        return $this->render('film/watchList.html.twig', [
            'controller_name' => 'FilmController',
            'watchList' => $watchList
        ]);
    }

    /**
     * @Route("/seen", name="seen")
     */
    public function getSeen(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $seen = $this->getUser()->getSeenMovies();
        return $this->render('film/seen.html.twig', [
            'controller_name' => 'FilmController',
            'seen' => $seen
        ]);
    }

    /**
     * @Route("/film/seen/{filmId}", name="toggleSeen")
     */
    public function toggleSeen(MovieRepository $movieRepository, UserRepository $userRepository, EntityManagerInterface $manager, $filmId): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $movie = $movieRepository->find($filmId);
        $user = $userRepository->find($this->getUser()->getId());

        if ($movie->getSeen()->contains($user)) {
            $movie->removeSeen($user);
        } else {
            $movie->addSeen($user);
        }

        $manager->persist($movie);
        $manager->flush();

        $movies = $movieRepository->findAll();
        return $this->redirectToRoute('film');
    }

    /**
     * @Route("/film/watchlist/{filmId}", name="toggleWatchList")
     */
    public function toggleWatchList(MovieRepository $movieRepository, UserRepository $userRepository, EntityManagerInterface $manager, $filmId): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $movie = $movieRepository->find($filmId);
        $user = $userRepository->find($this->getUser()->getId());

        if ($movie->getWatchList()->contains($user)) {
            $movie->removeWatchList($user);
        } else {
            $movie->addWatchList($user);
        }

        $manager->persist($movie);
        $manager->flush();

        $movies = $movieRepository->findAll();
        return $this->redirectToRoute('film');
    }
}
